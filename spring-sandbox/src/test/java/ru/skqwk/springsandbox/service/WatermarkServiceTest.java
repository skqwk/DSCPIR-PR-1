package ru.skqwk.springsandbox.service;

import org.junit.jupiter.api.Test;

import java.io.IOException;

import static org.junit.jupiter.api.Assertions.*;

class WatermarkServiceTest {

    private final WatermarkService watermarkService = new WatermarkService();

    @Test
    void addWatermark() throws IOException {
      watermarkService.addWatermark("plot_pie");
    }
}