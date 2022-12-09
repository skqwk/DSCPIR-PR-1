package ru.skqwk.springsandbox.dto;

import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Getter;
import lombok.NoArgsConstructor;

@Getter
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class WeatherReportDto {
    private Long id;
    private String timestamp;
    private Double temperature;
    private Double windSpeed;
    private Double pressure;
}
