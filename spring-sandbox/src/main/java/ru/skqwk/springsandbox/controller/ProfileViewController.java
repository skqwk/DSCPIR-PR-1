package ru.skqwk.springsandbox.controller;

import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import ru.skqwk.springsandbox.domain.UserAccount;

@Controller
public class ProfileViewController {

    @GetMapping("/")
    public String profile(@AuthenticationPrincipal UserAccount userAccount, Model model) {
        model.addAttribute("user", userAccount);
        return "profile";
    }

}
