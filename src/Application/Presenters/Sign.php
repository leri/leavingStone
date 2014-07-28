<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Leri
 * Date: 7/27/14
 * Time: 5:44 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Twitter\Application\Presenters;


use Twitter\Application\PresentationModels\Login;
use Twitter\Application\PresentationModels\Registration;
use Twitter\Application\Presenter;
use Twitter\Helpers\UrlGenerator;
use Twitter\Http\DefaultResponse;
use Twitter\Http\Response;

class Sign implements Presenter {
    private $urlGenerator;
    private $loginErrors;
    private $registrationErrors;
    private $loginModel;
    private $registrationModel;

    public function setLoginModel(Login $login) {
        $this->loginModel = $login;
    }

    public function setRegistrationModel(Registration $registration) {
        $this->registrationModel = $registration;
    }

    /**
     * gets response object.
     * @return Response
     */
    public function getResponse() {
        $response = new DefaultResponse();

        $response->setBody($this->render());

        return $response;
    }

    private function render() {
        ob_start();

        require_once TEMPLATE_DIR.'/sign.php';

        return ob_get_clean();
    }

    public function __construct(UrlGenerator $urlGenerator, array $loginErrors, array $registrationErrors) {
        $this->urlGenerator = $urlGenerator;
        $this->loginErrors = $loginErrors;
        $this->registrationErrors = $registrationErrors;
    }
}