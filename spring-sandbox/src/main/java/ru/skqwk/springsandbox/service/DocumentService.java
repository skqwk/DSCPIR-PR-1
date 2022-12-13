package ru.skqwk.springsandbox.service;

import org.springframework.core.io.InputStreamSource;
import org.springframework.web.multipart.MultipartFile;
import ru.skqwk.springsandbox.dto.DocumentMetadata;

import java.io.InputStream;
import java.util.List;

/**
 * Описание класса
 */
public interface DocumentService {
    String loadDocument(String folder, MultipartFile file);
    void loadImage(String folder, String fileNameWithType, InputStream inputStream);
    List<DocumentMetadata> getLoadedDocuments(String username);
    void createFolder(String folder) throws Exception;
    boolean isFolderExists(String folder)  throws Exception;
    InputStream getDocument(String imageFolder, String fileName) throws Exception;

    String createHref(String s, String imageFolder);
}
