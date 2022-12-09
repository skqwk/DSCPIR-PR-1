package ru.skqwk.springsandbox.dto;

import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Getter;
import lombok.NoArgsConstructor;

/**
 * Описание класса
 */
@Getter
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class DocumentMetadata {
    private String filename;
    private String uploadDate;
    private String href;
}
