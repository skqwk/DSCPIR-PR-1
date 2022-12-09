package ru.skqwk.springsandbox.service;

import org.springframework.stereotype.Service;
import ru.skqwk.springsandbox.domain.WeatherReport;
import ru.skqwk.springsandbox.repo.WeatherReportRepository;

@Service
public class WeatherReportService extends AbstractService<WeatherReport> {
  protected WeatherReportService(WeatherReportRepository repository) {
    super("weatherReport", repository);
  }
}
