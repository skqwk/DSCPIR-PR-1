package ru.skqwk.springsandbox.controller;

import jakarta.servlet.http.HttpSession;
import org.springframework.security.core.annotation.AuthenticationPrincipal;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import ru.skqwk.springsandbox.domain.UserAccount;
import ru.skqwk.springsandbox.dto.Icon;

import java.util.List;
import java.util.Objects;

@Controller
public class ProfileViewController {

    private final List<Icon> icons = List.of(
            Icon.builder().name("Sun").value("sun.png").build(),
            Icon.builder().name("Cloud").value("cloud.png").build(),
            Icon.builder().name("Rain").value("rain.png").build(),
            Icon.builder().name("Snow").value("snow.png").build()
    );

    @GetMapping("/profile")
    public String profile(@AuthenticationPrincipal UserAccount userAccount, Model model) {
        model.addAttribute("user", userAccount);
        model.addAttribute("icons", icons);
        return "profile";
    }

    @PostMapping("/profile/session/username")
    public String username(@RequestParam(name = "username", required = false, defaultValue = "") String username,
                          HttpSession session) {
        session.setAttribute("username", username);
        return "redirect:/profile";
    }
    @PostMapping("/profile/session/icon")
    public String icon(@RequestParam(name = "icon", required = false, defaultValue = "sun.png") String icon,
                       HttpSession session) {
        session.setAttribute("icon", icon);
        return "redirect:/profile";
    }

    @PostMapping("/profile/session/switch")
    public String theme(@RequestParam(name = "switch", required = false, defaultValue = "light") String switchTheme,
                       HttpSession session) {
        Object nowSwitchTheme = session.getAttribute("switch");
        session.setAttribute("switch", toggle(nowSwitchTheme));
        return "redirect:/profile";
    }

    private String toggle(Object nowSwitchTheme) {
        if (Objects.isNull(nowSwitchTheme)) {
            return "light";
        } else {
            return nowSwitchTheme.toString().equals("light") ? "dark" : "light";
        }
    }

}
