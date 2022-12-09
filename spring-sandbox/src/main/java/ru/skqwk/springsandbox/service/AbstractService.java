package ru.skqwk.springsandbox.service;

import org.springframework.data.jpa.repository.JpaRepository;
import ru.skqwk.springsandbox.exception.ResourceNotFoundException;

import java.util.List;

public abstract class AbstractService<T> implements CrudService<T> {

  private final String domainName;
  private final JpaRepository<T, Long> repository;

  protected AbstractService(String domainName, JpaRepository<T, Long> repository) {
    this.domainName = domainName;
    this.repository = repository;
  }

  @Override
  public List<T> findAll() {
    return repository.findAll();
  }

  @Override
  public T save(T t) {
    return repository.save(t);
  }

  @Override
  public T update(Long id, T t) {
    findById(id);
    t = setId(t, id);
    return repository.save(t);
  }

  @Override
  public T findById(Long id) {
    return repository
        .findById(id)
        .orElseThrow(
            () ->
                new ResourceNotFoundException(
                    String.format("%s with id = %s not found", domainName, id)));
  }

  @Override
  public void deleteById(Long id) {
    findById(id);
    repository.deleteById(id);
  }

  public abstract T setId(T t, Long id);
}
