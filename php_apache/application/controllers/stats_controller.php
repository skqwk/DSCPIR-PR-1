<?
include_once '../application/core/controller.php';
include_once '../application/models/stats_model.php';

class StatsController extends Controller {
    
    private $model;
    
    public function __construct() {
        parent::__construct();
        $this->model = new StatsModel();
    }

    public function main_action() {
        $data = $this->model->get_data();
        $images = $this->model->get_images();
        $data = array(
            'data' => $data,
            'images' => $images,
            'title' => 'Stats'
        );
        $this->view->show('stats_view.php', 'template_view.php', $data);
    }
}

?>