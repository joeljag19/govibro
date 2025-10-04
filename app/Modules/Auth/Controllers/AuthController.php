<?php
namespace App\Modules\Auth\Controllers;

use App\Modules\Auth\Models\UserAuthModel;
use App\Modules\Commissions\Models\ResellerModel;
use App\Modules\Commissions\Models\SellerModel;
use App\Modules\Commissions\Models\SellerInvitationModel;
use App\Modules\Commissions\Models\AuditLogModel;

use App\Modules\Commissions\Models\TrackingLinkModel; 
use App\Modules\Commissions\Models\CustomerResellerInteractionModel;


class AuthController extends \CodeIgniter\Controller
{
    protected $userModel;
    protected $db;
    protected $resellerModel;
    protected $sellerModel;
    protected $invitationModel;
    protected $auditLogModel;

    public function __construct()
    {
        $this->userModel = new UserAuthModel();
        $this->db = \Config\Database::connect();
        $this->resellerModel = new ResellerModel();
        $this->sellerModel = new SellerModel();
        $this->invitationModel = new SellerInvitationModel();
        $this->auditLogModel = new AuditLogModel();
    }

    // Método para mostrar el formulario de login (GET)
    public function showLoginForm()
    {
        if (session()->has('user')) {
            log_message('debug', 'Usuario ya autenticado, redirigiendo a /admin');
            return redirect()->to('/admin')->with('info', 'Ya estás autenticado.');
        }

        log_message('debug', 'Mostrando formulario de login');
        return view('App\Modules\Auth\Views\login');
    }

    // Método para procesar el login (POST)
    public function processLogin()
    {
        if (session()->has('user')) {
            log_message('debug', 'Usuario ya autenticado, redirigiendo a /admin');
            return redirect()->to('/admin')->with('info', 'Ya estás autenticado.');
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        log_message('debug', 'Intento de login con email: ' . ($email ?? 'No proporcionado'));

        // Validar que se proporcionaron email y contraseña
        if (empty($email) || empty($password)) {
            log_message('error', 'Email o contraseña no proporcionados');
            return redirect()->to('/auth/login')->with('error', 'Por favor, proporciona un correo electrónico y una contraseña.');
        }

        $user = $this->userModel->validateCredentials($email, $password);
        if ($user) {
            log_message('debug', 'Usuario autenticado exitosamente: ' . $user['id']);
            session()->set('user', [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'language' => $user['language'] ?? 'en'
            ]);

            // Registrar en audit_logs
            $this->db->table('audit_logs')->insert([
                'user_id' => $user['id'],
                'action' => 'Inicio de sesión',
                'entity_type' => 'user',
                'entity_id' => $user['id'],
                'details' => json_encode(['email' => $email]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->to('/admin/dashboard')->with('success', 'Bienvenido, ' . $user['name']);
        } else {
            log_message('error', 'Fallo en la autenticación para el email: ' . $email);
            return redirect()->to('/auth/login')->with('error', 'Credenciales inválidas. Por favor, verifica tu correo electrónico y contraseña.');
        }
    }

    public function logout()
    {
        $userId = session('user')['id'] ?? null;

        // Registrar en audit_logs
        if ($userId) {
            $this->db->table('audit_logs')->insert([
                'user_id' => $userId,
                'action' => 'Cierre de sesión',
                'entity_type' => 'user',
                'entity_id' => $userId,
                'details' => json_encode(['email' => session('user')['email']]),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        session()->destroy();
        return redirect()->to('/')->with('success', 'Sesión cerrada exitosamente.');
    }

      public function register()
    {
        if (session()->has('user')) {
            return redirect()->to('/admin')->with('info', 'Ya estás autenticado.');
        }

        if ($this->request->getMethod() === 'post') {
            $data = [
                'name'     => $this->request->getPost('name'),
                'email'    => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'role'     => $this->request->getPost('role') ?? 'customer', // Cambiado a 'customer' por defecto
                'language' => $this->request->getPost('language') ?? 'en'
            ];

            if (!$data['name'] || !$data['email'] || !$data['password']) {
                return redirect()->back()->with('error', 'Todos los campos son obligatorios.');
            }

            if ($this->userModel->getByEmail($data['email'])) {
                return redirect()->back()->with('error', 'El correo electrónico ya está registrado.');
            }

            $userId = $this->userModel->register($data);

            if ($userId) {
                // Después de registrar al usuario, verificamos si vino de un enlace de afiliado.
                $refCode = $this->request->getCookie('ref_code');
                $refDate = $this->request->getCookie('ref_date');

                if ($refCode) {
                    $trackingLinkModel = new TrackingLinkModel();
                    $link = $trackingLinkModel->getByCode($refCode);

                    if ($link) {
                        // El usuario vino de un enlace válido. Creamos la asociación permanente.
                        $interactionModel = new CustomerResellerInteractionModel();
                        $interactionData = [
                            'customer_id'      => $userId, // El ID del usuario recién creado
                            'reseller_id'      => $link['reseller_id'],
                            'seller_id'        => $link['seller_id'],
                            'unique_code'      => $refCode,
                            'interaction_date' => $refDate ?? date('Y-m-d H:i:s') // Usamos la fecha original del clic si está disponible
                        ];
                        $interactionModel->insert($interactionData);

                        // Opcional: Limpiar las cookies una vez usadas
                        $this->response->deleteCookie('ref_code');
                        $this->response->deleteCookie('ref_date');
                    }
                }
                // --> FIN DE LA LÓGICA AÑADIDA <--

                return redirect()->to('/auth/login')->with('success', 'Usuario registrado exitosamente. Por favor, inicia sesión.');
            } else {
                return redirect()->back()->with('error', 'Error al registrar el usuario.');
            }
        }

        return view('App\Modules\Auth\Views\register');
    }

    public function profile()
    {
        if (!session()->has('user')) {
            log_message('error', 'Intento de acceso al perfil sin autenticación');
            return redirect()->to('/auth/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        $user = session('user');
        $data = [
            'user' => $this->userModel->find($user['id']),
            'bookings' => $this->userModel->getBookings($user['id']),
            'reviews' => $this->userModel->getReviews($user['id']),
            'wishlist' => $this->userModel->getWishlist($user['id']),
        ];

        return view('App\Modules\Auth\Views\profile', $data);
    }

    /**
     * Muestra el formulario de registro como candidato a revendedor o vendedor.
     *
     * @param string|null $invitationCode
     * @return string
     */

    public function showRegisterCandidate()
    {
        if (session()->has('user')) {
            return redirect()->to('/admin');
        }

        $invitationCode = $this->request->getGet('invitation_code');
        $invitationData = null;

        if ($invitationCode) {
            $invitationModel = new SellerInvitationModel();
            $invitationData = $invitationModel->getByCode($invitationCode);

            // Si el código de invitación no es válido o ya fue usado, redirigir con un error.
            if (!$invitationData || $invitationData['status'] !== 'pending') {
                return redirect()->to('/auth/login')->with('error', 'Este enlace de invitación no es válido o ya ha sido utilizado.');
            }
        }

        // Pasamos todos los datos de la invitación a la vista.
        return view('App\Modules\Auth\Views\register_candidate', [
            'invitation' => $invitationData
        ]);
    }

    /**
     * Registra a un usuario como candidato a revendedor o vendedor.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function registerCandidate()
    {
        // Validación de Contraseña y Documento de Identidad
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');
        if ($password !== $passwordConfirm) {
            return redirect()->back()->withInput()->with('error', 'Las contraseñas no coinciden.');
        }
        $identityDocument = $this->request->getPost('identity_document');
        if (empty($identityDocument)) {
            return redirect()->back()->withInput()->with('error', 'El documento de identidad es obligatorio.');
        }

        $invitationCode = $this->request->getPost('invitation_code');
        $email          = $this->request->getPost('email');
        $firstName      = $this->request->getPost('first_name');
        $lastName       = $this->request->getPost('last_name');

        // Flujo 1: Registro con invitación
        if ($invitationCode) {
            $invitationModel = new SellerInvitationModel();
            $invitation = $invitationModel->getByCode($invitationCode);

            if (!$invitation || $invitation['status'] !== 'pending' || strtolower($invitation['invitee_email']) !== strtolower($email)) {
                return redirect()->back()->withInput()->with('error', 'El código de invitación no es válido, ha expirado o no corresponde a este email.');
            }

            $db = \Config\Database::connect();
            $db->transBegin();
            try {
                // 1. Crear el usuario
                $userId = $this->userModel->register([
                    'name'     => $firstName . ' ' . $lastName,
                    'email'    => $email,
                    'password' => $password,
                    'role'     => 'seller',
                ]);

                // 2. Crear el registro de vendedor (seller)
                $sellerModel = new SellerModel();
                $sellerData = [
                    'user_id' => $userId,
                    'reseller_id' => $invitation['reseller_id'],
                    'commission_percentage' => $invitation['commission_percentage'],
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'address' => $this->request->getPost('address'),
                    'phone' => $this->request->getPost('phone'),
                    'identity_document' => $identityDocument,
                ];
                $sellerId = $sellerModel->insert($sellerData);

                // 3. Generar el enlace de seguimiento
                $trackingLinkModel = new TrackingLinkModel();
                $trackingLinkModel->generateDefaultLink($invitation['reseller_id'], $sellerId);

                // 4. Actualizar la invitación
                $invitationModel->update($invitation['id'], ['status' => 'accepted']);

                if ($db->transStatus() === false) {
                    $db->transRollback();
                    return redirect()->back()->withInput()->with('error', 'Error en la transacción de la base de datos.');
                } else {
                    $db->transCommit();
                    return redirect()->to('/auth/login')->with('success', '¡Registro completado! Ya puedes iniciar sesión como Vendedor.');
                }

            } catch (\Throwable $e) {
                $db->transRollback();
                log_message('error', '[registerCandidate with Invite] ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Ocurrió un error inesperado durante el registro.');
            }
        } else {
            // Flujo 2: Registro sin invitación
            $candidateType = $this->request->getPost('candidate_type');
            if (empty($candidateType)) {
                return redirect()->back()->withInput()->with('error', 'Debe seleccionar un tipo de candidatura.');
            }
            $role = ($candidateType === 'seller') ? 'seller_candidate' : 'reseller_candidate';

            $data = [
                'name'     => $firstName . ' ' . $lastName,
                'email'    => $email,
                'password' => $password,
                'role'     => $role,
            ];

            $userId = $this->userModel->register($data);

            if($userId){
                $this->auditLogModel->log(null, 'Solicitud de registro como ' . $candidateType, 'user', $userId, ['email' => $email, 'candidate_type' => $candidateType]);
                return redirect()->to('/auth/login')->with('success', 'Tu solicitud ha sido recibida y será revisada por un administrador.');
            } else {
                return redirect()->back()->withInput()->with('error', 'No se pudo completar la solicitud de registro.');
            }
        }
    }

// public function registerCandidate()
// {
//     // Validación de Contraseña y Documento de Identidad
//     $password = $this->request->getPost('password');
//     $passwordConfirm = $this->request->getPost('password_confirm');
//     if ($password !== $passwordConfirm) {
//         return redirect()->back()->withInput()->with('error', 'Las contraseñas no coinciden.');
//     }
//     $identityDocument = $this->request->getPost('identity_document');
//     if (empty($identityDocument)) {
//         return redirect()->back()->withInput()->with('error', 'El documento de identidad es obligatorio.');
//     }

//     $invitationCode = $this->request->getPost('invitation_code');
//     $email          = $this->request->getPost('email');
//     $firstName      = $this->request->getPost('first_name');
//     $lastName       = $this->request->getPost('last_name');

//     // Flujo 1: Registro con invitación
//     if ($invitationCode) {
        
//         $db = \Config\Database::connect();
//         $db->transBegin();
        
//         try {
//             echo "Checkpoint 1: Iniciando proceso de invitación.<br>";

//             $invitationModel = new \App\Modules\Commissions\Models\SellerInvitationModel();
//             $invitation = $invitationModel->getByCode($invitationCode);

//             if (!$invitation || $invitation['status'] !== 'pending' || strtolower($invitation['invitee_email']) !== strtolower($email)) {
//                 return redirect()->back()->withInput()->with('error', 'El código de invitación no es válido, ha expirado o no corresponde a este email.');
//             }

//             echo "Checkpoint 2: Invitación validada correctamente.<br>";

//             // Crear el usuario
//             $userId = $this->userModel->register([
//                 'name'     => $firstName . ' ' . $lastName,
//                 'email'    => $email,
//                 'password' => $password,
//                 'role'     => 'seller',
//             ]);

//             echo "Checkpoint 3: Usuario registrado con ID: " . $userId . "<br>";

//             // Crear el registro de vendedor (seller)
//             $sellerModel = new \App\Modules\Commissions\Models\SellerModel();
//             $sellerData = [
//                 'user_id' => $userId,
//                 'reseller_id' => $invitation['reseller_id'],
//                 'commission_percentage' => $invitation['commission_percentage'],
//                 'first_name' => $firstName,
//                 'last_name' => $lastName,
//                 'address' => $this->request->getPost('address'),
//                 'phone' => $this->request->getPost('phone'),
//                 'identity_document' => $identityDocument,
//             ];
//             $sellerId = $sellerModel->insert($sellerData);

//             echo "Checkpoint 4: Vendedor creado con ID: " . $sellerId . "<br>";

//             // Generar el enlace de seguimiento
//             $trackingLinkModel = new \App\Modules\Commissions\Models\TrackingLinkModel();
//             $trackingLinkModel->generateDefaultLink($invitation['reseller_id'], $sellerId);

//             echo "Checkpoint 5: Enlace de seguimiento generado.<br>";

//             // Actualizar la invitación
//             $invitationModel->update($invitation['id'], ['status' => 'accepted']);

//             echo "Checkpoint 6: Invitación actualizada.<br>";

//             if ($db->transStatus() === false) {
//                 $db->transRollback();
//                 return redirect()->back()->withInput()->with('error', 'Error en la transacción.');
//             } else {
//                 $db->transCommit();
//                 // Comentamos la redirección final para poder ver los mensajes
//                 die("PROCESO COMPLETADO EXITOSAMENTE. Revisa la base de datos.");
//                 // return redirect()->to('/auth/login')->with('success', '¡Registro completado!');
//             }

//         } catch (\Throwable $e) {
//             $db->transRollback();
//             die("ERROR FATAL: " . $e->getMessage() . "<br>Archivo: " . $e->getFile() . "<br>Línea: " . $e->getLine());
//         }
//     } else {
//         // Flujo sin invitación (se mantiene igual)
//         // ...
//     }
// }


    /**
     * Muestra el formulario de registro para aspirantes a dueños de servicios.
     */
    public function showRegisterOwner()
    {
        if (session()->has('user')) {
            return redirect()->to('/admin');
        }
        return view('App\Modules\Auth\Views\register_owner');
    }

    /**
     * Procesa la solicitud de registro de un dueño de servicio.
     */
    public function registerOwnerCandidate()
    {
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        if ($password !== $passwordConfirm) {
            return redirect()->back()->withInput()->with('error', 'Las contraseñas no coinciden.');
        }

        if ($this->userModel->getByEmail($this->request->getPost('email'))) {
            return redirect()->back()->withInput()->with('error', 'El correo electrónico ya está registrado.');
        }

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => $password,
            'role'     => 'owner_candidate', // El nuevo rol intermedio
        ];

        $userId = $this->userModel->register($data);

        if ($userId) {
            $this->auditLogModel->log(null, 'Solicitud de registro como owner', 'user', $userId, ['email' => $data['email']]);
            return redirect()->to('/auth/login')->with('success', 'Tu solicitud ha sido recibida y será revisada por un administrador.');
        } else {
            return redirect()->back()->withInput()->with('error', 'No se pudo completar la solicitud de registro.');
        }
    }






}