package ru.skqwk.springsandbox.controller;

import lombok.RequiredArgsConstructor;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;
import ru.skqwk.springsandbox.domain.Location;
import ru.skqwk.springsandbox.dto.LocationDto;
import ru.skqwk.springsandbox.service.LocationService;

import java.util.List;

@RestController
@RequiredArgsConstructor
public class LocationCrudApiController extends BaseApiController{

  private final LocationService service;

  @GetMapping("/api/v1/location")
  public List<Location> findAll() {
    return service.findAll();
  }

  @PostMapping("/api/v1/location")
  public Location save(@RequestBody LocationDto location) {

    return service.save(mapLocationDtoToLocation(location));
  }

  @PutMapping("/api/v1/location/{id}")
  public Location update(@PathVariable(name = "id") Long id, @RequestBody LocationDto location) {
    return service.update(id, mapLocationDtoToLocation(location));
  }

  @GetMapping("/api/v1/location/{id}")
  public Location findById(@PathVariable(name = "id") Long id) {
    return service.findById(id);
  }

  @DeleteMapping("/api/v1/location/{id}")
  public void deleteById(@PathVariable(name = "id") Long id) {
    service.deleteById(id);
  }

  private Location mapLocationDtoToLocation(LocationDto location) {
    return Location.builder()
        .id(location.getId())
        .latitude(location.getLatitude())
        .longitude(location.getLongitude())
        .name(location.getName())
        .build();
  }
}
