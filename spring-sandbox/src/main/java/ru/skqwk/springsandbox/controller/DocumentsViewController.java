package ru.skqwk.springsandbox.controller;

import lombok.RequiredArgsConstructor;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.multipart.MultipartFile;
import ru.skqwk.springsandbox.domain.UserAccount;
import ru.skqwk.springsandbox.dto.DocumentMetadata;
import ru.skqwk.springsandbox.service.DocumentService;

import java.util.List;

@Controller
@RequiredArgsConstructor
public class DocumentsViewController {

    private final DocumentService documentService;

    @GetMapping("/documents")
    public String documents(@AuthenticationPrincipal UserAccount userAccount,
                            Model model) {
        List<DocumentMetadata> loadedDocuments = documentService.getLoadedDocuments(userAccount.getUsername());
        model.addAttribute("documents", loadedDocuments);
        return "documents";
    }

    @PostMapping("/documents")
    public String uploadDocument(
            @AuthenticationPrincipal UserAccount userAccount,
            @RequestParam("fileToUpload") MultipartFile file,
            Model model) {
        String status = documentService.loadDocument(userAccount.getUsername(), file);
        model.addAttribute("result", status);
        return "upload-result";
    }

}
