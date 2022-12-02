<?
include_once '../application/core/controller.php';
include_once '../application/models/documents_model.php';

class DocumentsController extends Controller {
    
    private $model;
    
    public function __construct() {
        parent::__construct();
        $this->model = new DocumentsModel();
    }

    public function main_action() {
        $documents = $this->model->get_loaded_documents();
        $data = array(
            'documents' => $documents,
            'login' => $login = $_SERVER['PHP_AUTH_USER'],
            'title' => 'Documents'
        );
        $this->view->show('documents_view.php', 'template_view.php', $data);
    }

    public function load_action() {
        $message = $this->model->load_documents();
        $data = array(
            'message' => $message,
            'title' => 'Documents'
        );
        $this->view->show('load_result_view.php', null, $data);
    }
}

?>