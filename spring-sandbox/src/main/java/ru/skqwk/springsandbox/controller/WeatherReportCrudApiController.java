package ru.skqwk.springsandbox.controller;

import lombok.RequiredArgsConstructor;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;
import ru.skqwk.springsandbox.domain.WeatherReport;
import ru.skqwk.springsandbox.dto.WeatherReportDto;
import ru.skqwk.springsandbox.service.WeatherReportService;

import java.util.List;

@RestController
@RequiredArgsConstructor
public class WeatherReportCrudApiController extends BaseApiController {

  private final WeatherReportService service;

  @GetMapping("/api/v1/weather-report")
  public List<WeatherReport> findAll() {
    return service.findAll();
  }

  @PostMapping("/api/v1/weather-report")
  public WeatherReport save(@RequestBody WeatherReportDto weatherReport) {
    return service.save(mapWeatherReportDtoToWeatherReport(weatherReport));
  }

  @PutMapping("/api/v1/weather-report/{id}")
  public WeatherReport update(
      @PathVariable(name = "id") Long id, @RequestBody WeatherReportDto weatherReport) {
    return service.update(id, mapWeatherReportDtoToWeatherReport(weatherReport));
  }

  @GetMapping("/api/v1/weather-report/{id}")
  public WeatherReport findById(@PathVariable(name = "id") Long id) {
    return service.findById(id);
  }

  @DeleteMapping("/api/v1/weather-report/{id}")
  public void deleteById(@PathVariable(name = "id") Long id) {
    service.deleteById(id);
  }

  private WeatherReport mapWeatherReportDtoToWeatherReport(WeatherReportDto weatherReport) {
    return WeatherReport.builder()
        .pressure(weatherReport.getPressure())
        .temperature(weatherReport.getTemperature())
        .windSpeed(weatherReport.getWindSpeed())
        .timestamp(weatherReport.getTimestamp())
        .id(weatherReport.getId())
        .build();
  }
}
