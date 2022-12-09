package ru.skqwk.springsandbox.service;

import org.springframework.core.io.InputStreamSource;
import org.springframework.web.multipart.MultipartFile;
import ru.skqwk.springsandbox.dto.DocumentMetadata;

import java.util.List;

/**
 * Описание класса
 */
public interface DocumentService {
    String loadDocument(String username, MultipartFile file);
    List<DocumentMetadata> getLoadedDocuments(String username);
}
