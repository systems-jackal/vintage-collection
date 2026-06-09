package com.spectrenode.controller;

import com.spectrenode.dto.RegisterRequest;
import com.spectrenode.dto.auth.LoginRequest;
import com.spectrenode.dto.auth.LoginResponse;
import com.spectrenode.model.User;
import com.spectrenode.service.AuthService;
import com.spectrenode.service.UserService;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/auth")
public class AuthController {

    private final UserService userService;
    private final AuthService authService;

    public AuthController(
            UserService userService,
            AuthService authService) {

        this.userService = userService;
        this.authService = authService;
    }

    @PostMapping("/register")
    public User register(
            @RequestBody RegisterRequest request) {

        return userService.register(request);
    }

    @PostMapping("/login")
    public LoginResponse login(
            @RequestBody LoginRequest request) {

        return authService.login(request);
    }
}