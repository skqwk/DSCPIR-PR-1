<?php
require_once '../../vendor/autoload.php';
require_once 'FakeDataInstance.php';

function generateData() {
    $AMOUNT_ROWS = 50;
    $data = array();
    $emojis = array(
        '🌧️','☀️','☁️','⛅','🌩️'
    );
    $faker = Faker\Factory::create();
    $faker->addProvider(new Faker\Provider\ru_RU\Person($faker));
    $faker->addProvider(new Faker\Provider\ru_RU\Address($faker));

    for ($i = 0; $i < $AMOUNT_ROWS; $i++) {
        $row = new FakeDataInstance(
            $faker->address(),
            $emojis[$faker->numberBetween(0, count($emojis) - 1)],
            $faker->randomFloat(1, 20, 30),
            $faker->randomFloat(1, 740, 770),
            $faker->dateTimeInInterval('-4 month', '+5 days'),
            $faker->randomFloat(1, 0, 10),
        );
        $data[] = $row;
    }
    $jsonData = json_encode($data);
    file_put_contents('data.json', $jsonData);
}
?>