package ru.skqwk.springsandbox.service;

import io.minio.BucketExistsArgs;
import io.minio.ListObjectsArgs;
import io.minio.MakeBucketArgs;
import io.minio.MinioClient;
import io.minio.PutObjectArgs;
import io.minio.Result;
import io.minio.SetBucketPolicyArgs;
import io.minio.messages.Item;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Service;
import org.springframework.web.multipart.MultipartFile;
import ru.skqwk.springsandbox.config.MinioConfig;
import ru.skqwk.springsandbox.dto.DocumentMetadata;

import java.util.List;
import java.util.stream.Collectors;
import java.util.stream.StreamSupport;

/**
 * Описание класса
 */
@Service
@RequiredArgsConstructor
public class MinioDocumentService implements DocumentService {

    private final MinioClient minioClient;
    private final MinioConfig minioConfig;

    @Override
    public String loadDocument(String username, MultipartFile file) {
        String status = "Успешно загружен";
        try {
            minioClient.putObject(
                    PutObjectArgs.builder().bucket(username).object(file.getOriginalFilename()).stream(
                                    file.getInputStream(), file.getSize(), -1)
                            .contentType("application/pdf")
                            .build());
        } catch (Exception ex) {
            ex.printStackTrace();
            status = "Произошла ошибка";
        }
        return status;
    }

    @Override
    public List<DocumentMetadata> getLoadedDocuments(String username) {
        try {
            boolean found =
                    minioClient.bucketExists(BucketExistsArgs.builder().bucket(username).build());
            if (!found) {
                minioClient.makeBucket(MakeBucketArgs.builder()
                        .bucket(username).build());
                minioClient.setBucketPolicy(SetBucketPolicyArgs.builder()
                                .bucket(username)
                                .config(minioConfig.getPolicyJson(username))
                        .build());
            }
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        Iterable<Result<Item>> results = minioClient.listObjects(
                ListObjectsArgs.builder().bucket(username).build());

        List<DocumentMetadata> documents = StreamSupport.stream(results.spliterator(), false)
                .map(result -> mapResultToDocumentMetadata(result, username))
                .collect(Collectors.toList());
        return documents;
    }

    private DocumentMetadata mapResultToDocumentMetadata(Result<Item> result, String bucket) {
        DocumentMetadata documentMetadata = null;
        try {
            Item item = result.get();
            documentMetadata = DocumentMetadata.builder()
                    .filename(item.objectName())
                    .href(createHref(item.objectName(), bucket))
                    .uploadDate(item.lastModified().toLocalDateTime().toString())
                    .build();
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        return documentMetadata;
    }

    private String createHref(String fileName, String bucket) {
        return minioConfig.getMinioUrl() + "/" + bucket + "/" + fileName;
    }


}
