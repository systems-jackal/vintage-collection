package com.spectrenode.repository;

import com.spectrenode.model.Grade;
import org.springframework.data.jpa.repository.JpaRepository;

public interface GradeRepository
        extends JpaRepository<Grade, Long> {
}