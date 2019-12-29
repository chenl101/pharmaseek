# pharmaseek
A data-driven web application built with Javascript, PHP and MySQL.

1. Overview
PharmaSeek is a data-driven web application that aims to help users to look up or modify medicine info by searching medicine name, retailer or illness. This application is targeted at two groups of people. The first group is the everyday users who are looking for medicined related info including details of a specific medicine, its treating illness, sell by which retailers, and etc. Everyday users do not need to log in the system at all. Hence in our design, the homepage is always the user’s search mode unless you log in as an administrator.
The second group is the administrators of this database. Administrators need to login through the login page in order to access the administrator mode. Administrators could modify ( delete, add, or update) the current database within administrator mode.
2. Database
The raw data is retrieved from various places such as the FDA (U.S Food and Drug Administration) website, top ranking retailers, or randomized based on our demand. PhamaSeek database has 10 tables ( including 2 junction tables). The database includes 11,916 records. The database was created based on 2NF. The structure of the database is shown in Figure 1, and the E-R diagram is shown in Figure 2. The full DDL statement can be found at the end of this report.

#### **NOTE: This project is foucus on database design, but there the data is not garuanteed to be true or useful in real world.**
