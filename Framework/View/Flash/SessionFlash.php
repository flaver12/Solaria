<?php
/**
 * FlashClass
 *
 * @author Flavio Kleiber
 * @copyright (c) 2016-2017, Flavio Kleiber
 */
namespace Solaria\Framework\View\Flash;

use Solaria\Framework\Core\DiClass;

class SessionFlash extends DiClass{

    private $defaultClasses = array(
                "error"   => "alert alert-danger",
                "success" => "alert alert-success",
                "notice"  => "alert alert-info",
                "warning" => "alert alert-warning",
    );

    private $cssClasses = array();

    public function __construct($cssClasses = array()) {
        if(empty($cssClasses)) {
            $this->setCssClasses($this->defaultClasses);
        } else {
            $this->setCssClasses($cssClasses);
        }
    }

    private function setCssClasses($classes) {
        $this->cssClasses = $classes;
    }

    private function outputMessage($type, $message) {
        switch ($type) {
            case 'error':
                $message = '<div class="'.$this->cssClasses['error'].'">'.$message.'</div>';
                break;
            case 'success':
                $message = '<div class="'.$this->cssClasses['success'].'" role="alert">'.$message.'</div>';
                break;
            case 'notice':
                $message = '<div class="'.$this->cssClasses['notice'].'" role="alert">'.$message.'</div>';
                break;
            case 'warning':
                $message = '<div class="'.$this->cssClasses['warning'].'" role="alert">'.$message.'</div>';
                break;
        }
        $this->di->get('Session')->set('flash_message', $message);
    }

    public function render() {
        if($this->di->get('Session')->exist('flash_message')) {
            $message = $this->di->get('Session')->get('flash_message');
            $this->di->get('Session')->delete('flash_message');
            echo $message;
            return;
        }
    }

    public function error($msg) {
        $this->outputMessage('error', $msg);
    }

    public function success($msg) {
        $this->outputMessage('success', $msg);
    }

    public function notice($msg) {
        $this->outputMessage('notice', $msg);
    }

    public function warning($msg) {
        $this->outputMessage('warning', $msg);
    }

}
