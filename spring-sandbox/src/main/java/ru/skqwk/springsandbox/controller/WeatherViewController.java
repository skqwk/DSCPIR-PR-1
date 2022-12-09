package ru.skqwk.springsandbox.controller;

import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import ru.skqwk.springsandbox.service.WeatherReportService;

@Controller
@RequiredArgsConstructor
public class WeatherViewController {

    private final WeatherReportService weatherReportService;

    @GetMapping("/weather")
    public String weather(Model model) {
        model.addAttribute("weatherReports", weatherReportService.findAll());
        return "weather";
    }
}
