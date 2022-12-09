package ru.skqwk.springsandbox.service;

import org.jfree.chart.ChartFactory;
import org.jfree.chart.JFreeChart;
import org.jfree.chart.plot.PlotOrientation;
import org.jfree.data.category.CategoryDataset;
import org.jfree.data.category.DefaultCategoryDataset;
import org.jfree.data.general.DefaultPieDataset;
import org.jfree.data.general.PieDataset;
import org.springframework.stereotype.Service;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.util.Map;

@Service
public class PlotService extends ImageService {



  public String drawPlotPie(Map<String, Integer> data) {
    JFreeChart pieChart =
        ChartFactory.createPieChart(
            "Amount metrics", extractPlotPieDataset(data), true, true, false);

    return createImage("plot_pie", pieChart);
  }

  private PieDataset<String> extractPlotPieDataset(Map<String, Integer> data) {
    DefaultPieDataset<String> dataset = new DefaultPieDataset<>();
    for (String key : data.keySet()) {
      dataset.setValue(key, data.get(key));
    }
    return dataset;
  }

  public String drawPlotBar(Map<String, Integer> data) {
    JFreeChart barChart =
        ChartFactory.createBarChart(
            "Weather frequencies",
            "Weather",
            "Frequency",
            extractPlotBarDataset(data),
            PlotOrientation.VERTICAL,
            true,
            true,
            false);

    return createImage("plot_bar", barChart);
  }

  private CategoryDataset extractPlotBarDataset(Map<String, Integer> data) {
    DefaultCategoryDataset dataset = new DefaultCategoryDataset();
    for (String key : data.keySet()) {
      dataset.addValue(data.get(key), key, "Weather");
    }
    return dataset;
  }

  public String drawPlotGraph(Map<String, Double> data) {
    JFreeChart lineChart =
        ChartFactory.createLineChart(
            "Average temperature",
            "Date",
            "Temperature",
            extractPlotGraphDataset(data),
            PlotOrientation.VERTICAL,
            true,
            true,
            false);

    return createImage("plot_graph", lineChart);
  }

  private CategoryDataset extractPlotGraphDataset(Map<String, Double> data) {
    DefaultCategoryDataset dataset = new DefaultCategoryDataset();
    for (String date : data.keySet()) {
      dataset.addValue(data.get(date), "dates", date);
    }
    return dataset;
  }

  private String createImage(String fileName, JFreeChart chart) {
    String filePath = PATH + fileName + "." + IMAGE_TYPE;
    int width = 500;
    int height = 500;
    BufferedImage bufferedImage = chart.createBufferedImage(width, height);
    File image = new File(filePath);
    try {
      boolean result = ImageIO.write(bufferedImage, IMAGE_TYPE, image);
    } catch (IOException e) {
      e.printStackTrace();
    }
    return fileName + "." + IMAGE_TYPE;
  }
}
