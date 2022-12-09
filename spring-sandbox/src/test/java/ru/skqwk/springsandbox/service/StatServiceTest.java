package ru.skqwk.springsandbox.service;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class StatServiceTest {

    @Test
    void generateStats() {
        StatService service = new StatService();
        System.out.println(service.generateStats());
    }
}