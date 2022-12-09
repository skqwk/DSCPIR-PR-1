package ru.skqwk.springsandbox.dto;

import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.ToString;

@Getter
@Builder
@ToString
@NoArgsConstructor
@AllArgsConstructor
public class StatRow {
    private String location;
    private Double temperature;
    private Double pressure;
    private Double windSpeed;
    private String date;
    private String weather;
    private String emoji;
}
