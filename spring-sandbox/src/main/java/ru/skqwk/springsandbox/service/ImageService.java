package ru.skqwk.springsandbox.service;

import jakarta.annotation.PostConstruct;
import lombok.RequiredArgsConstructor;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.BufferedReader;
import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.nio.file.Path;
import java.nio.file.Paths;

@RequiredArgsConstructor
public abstract class ImageService {
    protected static final String IMAGE_TYPE = "png";
    protected static final String PATH = "/img/";
    protected static final String IMAGE_FOLDER = "img";

    private final DocumentService documentService;

    @PostConstruct
    public void init() {
        try {
            if (!documentService.isFolderExists(IMAGE_FOLDER)) {
                documentService.createFolder(IMAGE_FOLDER);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    static {
        Path path = Paths.get("").toAbsolutePath();
        System.out.println(path);
    }

    protected String saveImage(String fileName, BufferedImage image) throws IOException {
        ByteArrayOutputStream os = new ByteArrayOutputStream();
        ImageIO.write(image, IMAGE_TYPE, os);
        InputStream is = new ByteArrayInputStream(os.toByteArray());
        documentService.loadImage(IMAGE_FOLDER, fileName + "." + IMAGE_TYPE, is);
        return fileName;
    }

    protected BufferedImage getImage(String fileName) {
        BufferedImage image = null;
        try (InputStream is = documentService.getDocument(IMAGE_FOLDER, fileName + "." + IMAGE_TYPE)) {
            image = ImageIO.read(is);
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        return image;
    }

    protected String getImageHref(String fileName) {
        return documentService.createHref(fileName + "." + IMAGE_TYPE, IMAGE_FOLDER);
    }

}
