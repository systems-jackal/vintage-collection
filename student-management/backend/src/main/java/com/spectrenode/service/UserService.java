package com.spectrenode.service;

import com.spectrenode.dto.RegisterRequest;
import com.spectrenode.exception.EmailAlreadyExistsException;
import com.spectrenode.model.Role;
import com.spectrenode.model.User;
import com.spectrenode.repository.UserRepository;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

@Service
public class UserService {

    private final UserRepository userRepository;
    private final PasswordEncoder passwordEncoder;

    public UserService(
            UserRepository userRepository,
            PasswordEncoder passwordEncoder) {

        this.userRepository = userRepository;
        this.passwordEncoder = passwordEncoder;
    }

    public User register(RegisterRequest request) {

        if(userRepository.existsByEmail(
                request.getEmail())) {

            throw new EmailAlreadyExistsException(
                    "Email already exists");
        }

        User user = new User();

        user.setFirstName(request.getFirstName());
        user.setLastName(request.getLastName());
        user.setEmail(request.getEmail());

        user.setPassword(
                passwordEncoder.encode(
                        request.getPassword()));

        user.setRole(Role.STUDENT);

        return userRepository.save(user);
    }
}