package ru.skqwk.springsandbox.repo;

import org.springframework.data.jpa.repository.JpaRepository;
import ru.skqwk.springsandbox.domain.WeatherReport;

public interface WeatherReportRepository extends JpaRepository<WeatherReport, Long> {
}
