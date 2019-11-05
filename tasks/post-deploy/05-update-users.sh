#!/bin/bash

wp user create dpivo dpivo@greenpeace.org --first_name=Dylan --last_name="Pivo - P4 team" --role=administrator --porcelain || true
wp user create pcuadrad pcuadrad@greenpeace.org --first_name=Dylan --last_name="Cuadrado - P4 team" --role=administrator --porcelain || true
wp user create ttheodor ttheodor@greenpeace.org --first_name=Thanos --last_name="Theodorakopoulos - P4 team" --role=administrator --porcelain || true
wp user create nroussos nroussos@greenpeace.org --first_name=Nikos --last_name="Roussos - P4 team" --role=administrator --porcelain || true
wp user create sdeshmuk sdeshmuk@greenpeace.org --first_name=Sagar --last_name="Deshmukh - P4 team" --role=administrator --porcelain || true

wp user add-role atheodor@greenpeace.org subscriber || true
wp user remove-role atheodor@greenpeace.org administrator || true
wp user add-role kdiamant@greenpeace.org subscriber || true
wp user remove-role kdiamant@greenpeace.org administrator || true
wp user add-role koyandianthos@gmail.com subscriber || true
wp user remove-role koyandianthos@gmail.com administrator || true
wp user add-role kkokkoro@greenpeace.org subscriber || true
wp user remove-role kkokkoro@greenpeace.org administrator || true