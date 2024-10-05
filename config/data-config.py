from enum import Enum
from typing import List, Optional
from pydantic import BaseModel, Field, HttpUrl


# Enum for Star Types based on their spectral classification
class StarType(str, Enum):
    O = 'O-type'  # Hot, blue stars
    B = 'B-type'  # Blue stars
    A = 'A-type'  # White-blue stars
    F = 'F-type'  # Yellow-white stars
    G = 'G-type'  # Yellow stars (e.g., the Sun)
    K = 'K-type'  # Orange stars
    M = 'M-type'  # Red dwarfs (cool, faint stars)

# Enum for Exoplanet Types
class ExoplanetType(str, Enum):
    GAS_GIANT = 'Gas Giant'
    NEPTUNE_LIKE = 'Neptune-like'
    SUPER_EARTH = 'Super-Earth'
    TERRESTRIAL = 'Terrestrial'


# Pydantic model for individual publications
class Publication(BaseModel):
    link: HttpUrl = Field(..., description="URL link to the publication")
    description: str = Field(..., description="Brief description of the publication")


# Pydantic Model for Exoplanet, including host star and extended parameters
class ExoplanetModel(BaseModel):
    name: str = Field(..., description="Name of the exoplanet")
    mass: float = Field(..., description="Mass of the exoplanet in Earth masses (M⊕)")
    radius: float = Field(..., description="Radius of the exoplanet in Earth radii (R⊕)")
    orbital_period: float = Field(..., description="Orbital period in Earth days")
    semi_major_axis: float = Field(..., description="Semi-major axis of the orbit in AU (astronomical units)")
    eccentricity: float = Field(..., description="Orbital eccentricity (0 = circular orbit)")
    temperature: float = Field(..., description="Estimated surface temperature of the exoplanet in Kelvin")
    gravity: float = Field(..., description="Gravity index on the exoplanet relative to Earth's gravity")
    density: float = Field(..., description="Density of the exoplanet in g/cm³")
    habitability: bool = Field(..., description="Whether the planet is considered habitable (True/False)")
    surface_conditions: str = Field(..., description="Description of surface conditions (e.g., rocky, gaseous, water presence)")
    age: float = Field(..., description="Age of the exoplanet in billion years (Gyr)")
    distance_from_earth: float = Field(..., description="Distance from Earth in light years (ly)")
    travel_time: float = Field(..., description="Estimated travel time to the planet using current spacecraft in years")
    discovered_method: str = Field(..., description="Method used to discover the exoplanet (e.g., Transit, Radial Velocity)")

    # New Exoplanet Type field
    exoplanet_type: ExoplanetType = Field(..., description="Type of the exoplanet (Gas Giant, Neptune-like, Super-Earth, Terrestrial)")

    # Host star properties
    star_name: str = Field(..., description="Name of the host star")
    star_type: StarType = Field(..., description="Enum value representing the star's type (spectral class)")
    star_mass: float = Field(..., description="Mass of the star in solar masses (Msun)")
    star_radius: float = Field(..., description="Radius of the star in solar radii (Rsun)")
    star_temperature: float = Field(..., description="Temperature of the star in Kelvin")
    star_age: float = Field(..., description="Age of the star in billion years (Gyr)")

    # Visual assets
    planet_texture: Optional[str] = Field(None, description="Image file path of the visual texture of the planet")
    star_texture: Optional[str] = Field(None, description="Image file path of the visual texture of the host star")
    surface_photos: Optional[List[str]] = Field(None, description="List of image file paths for surface photos")
    locals_portrait: Optional[str] = Field(None, description="Image file path of the locals' portrait")
    flora_photos: Optional[List[str]] = Field(None, description="List of image file paths for possible flora")
    camp_photo: Optional[str] = Field(None, description="Image file path for a possible camp photo")
    background: Optional[str] = Field(None, description="Image file path for the background of the planet")

    # Publications related to the exoplanet
    publications: Optional[List[Publication]] = Field(None, description="List of publications with links and descriptions")
