package com.spectrenode.controller;

import com.spectrenode.dto.CreateGradeRequest;
import com.spectrenode.model.Grade;
import com.spectrenode.repository.GradeRepository;
import com.spectrenode.service.GradeService;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/grades")
public class GradeController {

    private final GradeService gradeService;
    private final GradeRepository gradeRepository;

    public GradeController(
            GradeService gradeService,
            GradeRepository gradeRepository) {

        this.gradeService = gradeService;
        this.gradeRepository = gradeRepository;
    }

    @PostMapping
    public Grade createGrade(
            @RequestBody CreateGradeRequest request) {

        return gradeService.gradeSubmission(request);
    }

    @GetMapping
    public List<Grade> getAllGrades() {
        return gradeRepository.findAll();
    }
}