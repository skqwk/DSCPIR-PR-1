package ru.skqwk.springsandbox.config;

import io.minio.MinioClient;
import jakarta.annotation.PostConstruct;
import lombok.Getter;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

/**
 * Конфигурация Minio
 */
@Getter
@Configuration
public class MinioConfig {

    @Value("${minio.host}")
    private String minioHost;

    @Value("${minio.server.port}")
    private String minioServerPort;

    @Value("${minio.console.port}")
    private String minioConsolePort;

    @Value("${minio.password}")
    private String minioPassword;

    @Value("${minio.user}")
    private String minioUser;

    private String minioUrl;

    @PostConstruct
    public void init() {
        minioUrl = "http://" + minioHost + ":" + minioServerPort;
    }

    public String getPolicyJson(String bucket) {
        return String.format("""
                 {
                     "Statement": [
                         {
                             "Action": [
                                 "s3:ListBucket"
                             ],
                             "Effect": "Allow",
                             "Principal": "*",
                             "Resource": "arn:aws:s3:::%s"
                         },
                         {
                             "Action": "s3:GetObject",
                             "Effect": "Allow",
                             "Principal": "*",
                             "Resource": "arn:aws:s3:::%s/*"
                         }
                     ],
                     "Version": "2012-10-17"
                 }
                
                """, bucket, bucket);
    }

    @Bean
    public MinioClient minioClient() {
        System.out.println(minioUser);
        System.out.println(minioPassword);
        System.out.println(minioConsolePort);
        System.out.println(minioServerPort);
        System.out.println(minioHost);


        return MinioClient.builder()
                .endpoint(minioUrl)
                .credentials(minioUser, minioPassword)
                .build();
    }


}
