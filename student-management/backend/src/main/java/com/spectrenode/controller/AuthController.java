package com.spectrenode.controller;

import com.spectrenode.dto.RegisterRequest;
import com.spectrenode.model.User;
import com.spectrenode.service.UserService;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/auth")
public class AuthController {

    private final UserService userService;

    public AuthController(UserService userService) {
        this.userService = userService;
    }

    @PostMapping("/register")
    public User register(
            @RequestBody RegisterRequest request) {

        return userService.register(request);
    }
}