package ru.skqwk.springsandbox.service;

import io.minio.BucketExistsArgs;
import io.minio.GetObjectArgs;
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

import java.io.InputStream;
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
    public void loadImage(String folder, String fileNameWithType, InputStream inputStream) {
        try {
            minioClient.putObject(
                    PutObjectArgs.builder().bucket(folder).object(fileNameWithType).stream(
                                    inputStream, -1, 10485760)
                            .contentType("image/png")
                            .build());
        } catch (Exception ex) {
            ex.printStackTrace();
        }
    }


    @Override
    public List<DocumentMetadata> getLoadedDocuments(String username) {
        try {
            if (!isFolderExists(username)) {
                createFolder(username);
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

    @Override
    public void createFolder(String folder) throws Exception {
        minioClient.makeBucket(MakeBucketArgs.builder()
                .bucket(folder).build());
        minioClient.setBucketPolicy(SetBucketPolicyArgs.builder()
                .bucket(folder)
                .config(minioConfig.getPolicyJson(folder))
                .build());
    }

    @Override
    public boolean isFolderExists(String folder) throws Exception {
        return
                minioClient.bucketExists(BucketExistsArgs.builder().bucket(folder).build());

    }

    @Override
    public InputStream getDocument(String folder, String fileName) throws Exception {
        return minioClient.getObject(
                GetObjectArgs.builder()
                        .bucket(folder)
                        .object(fileName)
                        .build());
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

    @Override
    public String createHref(String fileName, String bucket) {
        return "http://localhost:9001/" + bucket + "/" + fileName;
    }


}
