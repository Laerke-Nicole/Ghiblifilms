<?php
$query = $dbCon->prepare("SELECT * FROM News 
                            WHERE NewsID = :newsID");
$query->bindParam(':newsID', $newsID);
$query->execute();
$getNewsItem = $query->fetch();


// get everything from news
$queryNews = $dbCon->prepare("SELECT * FROM News");
$queryNews->execute();
$getNewsAdmin = $queryNews->fetchAll();


// get about ghiblifilms from db
$queryAboutCompany = $dbCon->prepare("SELECT NameOfCompany, CompanyDescription 
                                    FROM CompanyInformation");
$queryAboutCompany->execute();
$getAboutCompany = $queryAboutCompany->fetchAll();


// get everything from view with company address info 
$queryCompanyAddressView = $dbCon->prepare("SELECT *
                                            FROM CompanyAddressView");
$queryCompanyAddressView->execute();
$getCompanyAddressView = $queryCompanyAddressView->fetchAll();


// get company information
$queryCompanyInformation = $dbCon->prepare("SELECT C.*, A.StreetName, A.StreetNumber, A.PostalCode, A.Country 
                                            FROM CompanyInformation C 
                                            LEFT JOIN Address A 
                                            ON C.AddressID = A.AddressID");
$queryCompanyInformation->execute();
$getCompanyInformationAdmin = $queryCompanyInformation->fetchAll();


// Get everything from opening hours
$queryOpeningHour = $dbCon->prepare("SELECT * 
                                    FROM OpeningHour");
$queryOpeningHour->execute();
$getOpeningHour = $queryOpeningHour->fetchAll();