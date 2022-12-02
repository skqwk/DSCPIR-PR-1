<?
include_once '../application/core/controller.php';
include_once '../application/models/index_model.php';

class IndexController extends Controller {
    
    private $model;
    
    public function __construct() {
        parent::__construct();
        $this->model = new IndexModel();
    }

    public function main_action() {
        $result = $this->model->get_data();
        $icons = $this->model->get_icons();
        $data = array(
            'result' => $result,
            'title' => 'Profile',
            'icons' => $icons,
        );
        $this->view->show('index_view.php', 'template_view.php', $data);
    }

    public function session_action() {
        $this->model->update_cookies();
        HEADER('Location: /control/content');
    }
}
?>