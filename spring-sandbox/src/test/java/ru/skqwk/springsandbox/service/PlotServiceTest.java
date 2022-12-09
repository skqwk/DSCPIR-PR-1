package ru.skqwk.springsandbox.service;

import org.junit.jupiter.api.Test;
import ru.skqwk.springsandbox.dto.StatRow;

import java.util.List;
import java.util.Map;

import static org.junit.jupiter.api.Assertions.*;

class PlotServiceTest {

    private final StatService statService = new StatService();
    private final PlotService plotService = new PlotService();
    private List<StatRow> statRows = statService.generateStats();

    @Test
    void drawPlotGraph() {
      Map<String, Double> averageTemperature = statService.getAverageTemperature(statRows);
      plotService.drawPlotGraph(averageTemperature);
    }

    @Test
    void drawPlotPie() {
      Map<String, Integer> amountMetrics = statService.getAmountMetrics(statRows);
      plotService.drawPlotPie(amountMetrics);
    }

    @Test
    void drawPlotBar() {
      Map<String, Integer> amountWeather = statService.getAmountWeather(statRows);
      plotService.drawPlotBar(amountWeather);
    }
}