package ru.skqwk.springsandbox.service;

import java.util.List;

public interface CrudService<T> {
    List<T> findAll();
    T save(T t);
    T update(Long id, T t);
    T findById(Long id);
    void deleteById(Long id);
}
