package ru.skqwk.springsandbox.service;

import com.github.javafaker.Faker;
import com.github.javafaker.service.FakeValuesService;
import com.github.javafaker.service.RandomService;
import org.springframework.stereotype.Service;
import ru.skqwk.springsandbox.dto.StatRow;
import ru.skqwk.springsandbox.util.Formatter;

import java.security.SecureRandom;
import java.time.Instant;
import java.time.temporal.ChronoUnit;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;
import java.util.Map;

@Service
public class StatService {

  private static final int AMOUNT = 50;
  private final Faker faker = new Faker(new Locale("ru-RU"));
  private final SecureRandom random = new SecureRandom();
  private final List<String> weathers = List.of("Rainy", "Sunny","Cloudy", "Windy");
  private final List<String> emojis = List.of("🌧️","☀️","☁️","🌩️");

  public StatService() {}

  public Map<String, Double> getAverageTemperature(List<StatRow> stats) {
    Map<String, List<Double>> data = new HashMap<>();
    for (StatRow stat : stats) {
      List<Double> temperature = data.getOrDefault(stat.getDate(), new ArrayList<>());
      temperature.add(stat.getTemperature());
      data.put(stat.getDate(), temperature);
    }

    Map<String, Double> result = new HashMap<>();
    for (String s : data.keySet()) {
      result.put(
          s, data.get(s).stream().mapToDouble(Double::doubleValue).sum() / data.get(s).size());
    }
    return result;
  }

  public Map<String, Integer> getAmountWeather(List<StatRow> stats) {
    Map<String, Integer> data = new HashMap<>();
    for (StatRow stat : stats) {
      Integer amount = data.getOrDefault(stat.getWeather(), 0);
      data.put(stat.getWeather(), amount + 1);
    }
    return data;
  }

  public Map<String, Integer> getAmountMetrics(List<StatRow> stats) {
    Map<String, Integer> data = new HashMap<>();
    for (StatRow stat : stats) {
      Integer amount = data.getOrDefault(stat.getDate(), 0);
      data.put(stat.getDate(), amount + 1);
    }
    return data;
  }

  public List<StatRow> generateStats() {
    List<StatRow> stats = new ArrayList<>();
    for (int i = 0; i < AMOUNT; i++) {
      int weatherType = random.nextInt(weathers.size());
      stats.add(
          StatRow.builder()
              .temperature(faker.number().randomDouble(1, 20, 30))
              .location(faker.address().cityName() + ", " + faker.address().streetAddress())
              .date(
                  Formatter.format(
                      faker
                          .date()
                          .between(
                              Date.from(Instant.now().minus(30, ChronoUnit.DAYS)),
                              Date.from(Instant.now().minus(25, ChronoUnit.DAYS)))))
              .windSpeed(faker.number().randomDouble(2, 1, 15))
              .pressure(faker.number().randomDouble(1, 740, 770))
              .weather(weathers.get(weatherType))
              .emoji(emojis.get(weatherType))
              .build());
    }
    return stats;
  }
}
