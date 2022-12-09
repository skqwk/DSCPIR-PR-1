package ru.skqwk.springsandbox.service;

import org.springframework.stereotype.Service;
import ru.skqwk.springsandbox.domain.Location;
import ru.skqwk.springsandbox.repo.LocationRepository;

@Service
public class LocationService extends AbstractService<Location> {
  protected LocationService(LocationRepository repository) {
    super("location", repository);
  }
}
