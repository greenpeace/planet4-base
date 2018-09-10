wp user list --fields=user_login,user_email | grep amelekou; if [ $? != 0 ]; then wp user create amelekou amelekou@greenpeace.org --role=administrator --display_name="Anastasia" --first_name="Anastasia" --last_name="Melekou - Global Support" --porcelain --quiet; fi

wp user list --fields=user_login,user_email | grep apapamat; if [ $? != 0 ]; then wp user create apapamat apapamat@greenpeace.org --role=administrator --display_name="Athanasios" --first_name="Athanasios" --last_name="Papamathaiou - Global Support" --porcelain --quiet; fi

wp user list --fields=user_login,user_email | grep dgracian; if [ $? != 0 ]; then wp user create dgracian dgracian@greenpeace.org --role=administrator --display_name="Daniel" --first_name="Daniel" --last_name="Gracian - Global Support" --porcelain --quiet; fi

wp user list --fields=user_login,user_email | grep eberger; if [ $? != 0 ]; then wp user create eberger eberger@greenpeace.org --role=administrator --display_name="Ernesto" --first_name="Ernesto" --last_name="Berger - Global Support" --porcelain --quiet; fi

wp user list --fields=user_login,user_email | grep econsejo; if [ $? != 0 ]; then wp user create econsejo econsejo@greenpeace.org --role=administrator --display_name="Erick" --first_name="Erick" --last_name="Consejo - Global Support" --porcelain --quiet; fi

wp user list --fields=user_login,user_email | grep tzetterl; if [ $? != 0 ]; then wp user create tzetterl tzetterl@greenpeace.org --role=administrator --display_name="Torbjorn" --first_name="Torbjorn" --last_name="Zetterlund - Global Support" --porcelain --quiet; fi


wp user list --fields=user_login,user_email | grep atheodor; if [ $? != 0 ]; then wp user create atheodor atheodor@greenpeace.org --role=administrator --display_name="Angelos" --first_name="Angelos" --last_name="Theodorakopoulos  - P4 team" --porcelain --quiet; fi

wp user list --fields=user_login,user_email | grep kdiamant; if [ $? != 0 ]; then wp user create kdiamant kdiamant@greenpeace.org --role=administrator --display_name="Kyriakos" --first_name="Kyriakos" --last_name="Diamantis  - P4 team" --porcelain --quiet; fi

wp user list --fields=user_login,user_email | grep nroussos; if [ $? != 0 ]; then wp user create nroussos nroussos@greenpeace.org --role=administrator --display_name="Nikos" --first_name="Nikos" --last_name="Roussos  - P4 team" --porcelain --quiet; fi

wp user list --fields=user_login,user_email | grep sdeshmuk; if [ $? != 0 ]; then wp user create sdeshmuk sdeshmuk@greenpeace.org --role=administrator --display_name="Sagar" --first_name="Sagar" --last_name="Deshmukh  - P4 team" --porcelain --quiet; fi

wp user list --fields=user_login,user_email | grep rawalker; if [ $? != 0 ]; then wp user create rawalker rawalker@greenpeace.org --role=administrator --display_name="Ray" --first_name="Ray" --last_name="Walker  - P4 team" --porcelain --quiet; fi