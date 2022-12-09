package ru.skqwk.springsandbox.controller;

import lombok.AllArgsConstructor;
import lombok.RequiredArgsConstructor;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;
import ru.skqwk.springsandbox.dto.UserCredentials;
import ru.skqwk.springsandbox.service.UserService;

@RestController
@RequiredArgsConstructor
public class AuthApiController {
    private final UserService userService;

    @PostMapping("/api/v1/register")
    public void register(@RequestBody UserCredentials userCredentials) {
        userService.save(userCredentials);
    }
}
