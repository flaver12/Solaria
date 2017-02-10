<?php
/**
+------------------------------------------------------------------------+
| dev-storm.com                                                          |
+------------------------------------------------------------------------+
| Copyright (c) 2014 dev-storm.com Team                                  |
+------------------------------------------------------------------------+
| @author flaver <flaver@dev-storm.com>                                  |
| @copyright flaver, dev-storm.com                                       |
| @package devstorm.mail                                                 |
| @desc mail                                                             |
+------------------------------------------------------------------------+
 */
namespace devStorm\Library\Mail;
use Phalcon\Mvc\User\Component;
use Phalcon\Mvc\View;

class Mail extends Component {

    public function setTemplate($template) {
        if(!file_exists(APP_PATH.'/app/views/emailTemplates/'.$template.'.html')) {
            throw new \Exception('FAIL TO LOAD TEMPLATE');
        } else {
            $this->_template = file_get_contents(APP_PATH.'/app/views/emailTemplates/'.$template.'.html');
        }
    }

    public function send($to='', $subject="", $params) {
        $mail = new \PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host =  $this->config->mail->server;
        $mail->Port = 25;
        $mail->Username = $this->config->mail->username;
        $mail->Password = $this->config->mail->password;
        $mail->SetFrom($this->config->mail->fromEmail, $this->config->mail->fromName);
        $mail->Subject =$subject;
        if(!empty($params))
            $this->parseTemplate($params);
        $mail->MsgHTML($this->_template);
        $mail->addAddress($to);
        if(!$mail->Send()) {
            echo $mail->ErrorInfo;die;
            $logger = new Logger(APP_PATH . '/app/logs/error.log');
            $logger->error($mail->ErrorInfo);
            return false;
        }
        return true;

    }

    private function parseTemplate($params = array()) {
        foreach($params as $key => $value) {
            $this->_template = preg_replace('/###'.$key.'###/', $value, $this->_template);
        }
    }
}

?>