<?
include_once '../application/core/controller.php';
include_once '../application/models/weather_model.php';

class WeatherController extends Controller {
    
    private $model;
    
    public function __construct() {
        parent::__construct();
        $this->model = new WeatherModel();
    }

    public function main_action() {
        $result = $this->model->get_data();
        $data = array(
            'result' => $result,
            'title' => 'Weather'
        );
        $this->view->show('weather_view.php', 'template_view.php', $data);
    }
}

?>