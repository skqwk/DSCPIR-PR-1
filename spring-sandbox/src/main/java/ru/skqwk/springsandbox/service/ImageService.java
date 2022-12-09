package ru.skqwk.springsandbox.service;

import java.nio.file.Path;
import java.nio.file.Paths;

public abstract class ImageService {
    protected static final String IMAGE_TYPE = "png";
    protected static final String PATH = "spring-sandbox/src/main/resources/public/img/";

    static {
        Path path = Paths.get("").toAbsolutePath();
        System.out.println(path);
    }

}
