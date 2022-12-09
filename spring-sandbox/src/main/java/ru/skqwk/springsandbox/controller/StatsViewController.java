package ru.skqwk.springsandbox.controller;

import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import ru.skqwk.springsandbox.dto.StatRow;
import ru.skqwk.springsandbox.service.PlotService;
import ru.skqwk.springsandbox.service.StatService;
import ru.skqwk.springsandbox.service.WatermarkService;

import java.util.List;

@Controller
@RequiredArgsConstructor
public class StatsViewController {

    private final StatService statService;
    private final PlotService plotService;
    private final WatermarkService watermarkService;

    @GetMapping("/stats")
    public String stats(Model model) throws Exception {
        List<StatRow> stats = statService.generateStats();

        String plotPie = plotService.drawPlotPie(statService.getAmountMetrics(stats));
        watermarkService.addWatermark(plotPie);

        String plotBar = plotService.drawPlotBar(statService.getAmountWeather(stats));
        watermarkService.addWatermark(plotBar);

        String plotGraph = plotService.drawPlotGraph(statService.getAverageTemperature(stats));
        watermarkService.addWatermark(plotGraph);


        model.addAttribute("images", List.of(plotBar, plotPie, plotGraph));
        model.addAttribute("statRows", stats);
        return "stats";
    }
}
