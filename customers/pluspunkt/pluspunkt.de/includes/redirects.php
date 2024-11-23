<?php
    if(preg_match('/unternehmensnachfolge\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/persoenliche/fuehrungsseminar/unternehmensnachfolge');
        exit;
    }
    if(preg_match('/fuehrungsseminar\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/persoenliche/fuehrungsseminar');
        exit;
    }
    if(preg_match('/krisenmanagement\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/perspektivische');
        exit;
    }
    if(preg_match('/presse_1\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/erfolgsfaktoren/selbstverstaendnis');
        exit;
    }
    if(preg_match('/partner\/index\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv');
        exit;
    }
    if(preg_match('/potenzialanalyse\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/38/keine-angst-vorm-rating.html');
        exit;
    }
    if(preg_match('/rhetorikspezial\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/unternehmerische/incentive');
        exit;
    }
    if(preg_match('/bankenrating-basel2\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/38/keine-angst-vorm-rating.html');
        exit;
    }
    if(preg_match('/baecker-handwerk\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv');
        exit;
    }
    if(preg_match('/selfcoaching\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/57/selfcoaching-programm.html');
        exit;
    }
    if(preg_match('/impressum\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/impressum');
        exit;
    }
    if(preg_match('/konfliktmoderation-mediation\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/1/fehler-bei-kritikgespraechen-die-sie-vermeiden-sollten.html');
        exit;
    }
    if(preg_match('/formular\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/impressum/kontakt');
        exit;
    }
    if(preg_match('/broeker\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv');
        exit;
    }
    if(preg_match('/potenzialentwicklung\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/39/potenzialentwicklung-bei-phoenix-contact.html');
        exit;
    }
    if(preg_match('/leistungen\/index\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen');
        exit;
    }
    if(preg_match('/dimento\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/69/bookmarks-online-verwalten.html');
        exit;
    }
    if(preg_match('/fuehrung\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/persoenliche/fuehrungsseminar');
        exit;
    }
    if(preg_match('/seminare\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen');
        exit;
    }
    if(preg_match('/coaching\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/persoenliche/individuelles-coaching');
        exit;
    }
    if(preg_match('/kommunikation\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/persoenliche/kommunikationstraining');
        exit;
    }
    if(preg_match('/moderation\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/perspektivische');
        exit;
    }
    if(preg_match('/home\/index\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/');
        exit;
    }
    if(preg_match('/kontakt\/index\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/impressum/kontakt');
        exit;
    }
    if(preg_match('/insights-methode2\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/persoenliche/verhaltenspraeferenz/insights-kurzbeschreibung');
        exit;
    }
    if(preg_match('/top-seminar\/index\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/persoenliche/fuehrungskraeftetraining-exzellent');
        exit;
    }
    if(preg_match('/insights-methode\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/persoenliche/verhaltenspraeferenz/insights-kurzbeschreibung');
        exit;
    }
    if(preg_match('/atmosfair\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/47/atmosfair.html');
        exit;
    }
    if(preg_match('/warum-wir\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/erfolgsfaktoren/versprechen');
        exit;
    }
    if(preg_match('/reha-klinik\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv');
        exit;
    }
    if(preg_match('/site-map\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/sitemap');
        exit;
    }
    if(preg_match('/newsletter-anmeldung\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletter');
        exit;
    }
    if(preg_match('/dvd-trainer-videos\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/73/dvd-trainer.html');
        exit;
    }
    if(preg_match('/beziehungskrisen-meistern\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/27/schlechte-zeiten-in-der-beziehung-und-wie-man-sie-meistert.html');
        exit;
    }
    if(preg_match('/dvd-trainer-presse\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/73/dvd-trainer.html');
        exit;
    }
    if(preg_match('/bericht-rating\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/38/keine-angst-vorm-rating.html');
        exit;
    }
    if(preg_match('/lit-campus\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/22/campus-management-ein-lexikon-fuers-management.html');
        exit;
    }
    if(preg_match('/partner-schlotmann\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/62/schlotmann-partner.html');
        exit;
    }
    if(preg_match('/gung-ho\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/13/ken-blanchard-sheldon-bowles-gung-ho--wie-sie-jedes-team-in-hoechstform-bringen.html');
        exit;
    }
    if(preg_match('/fuehrungstipp-schulungsbudget\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/50/fuehrungstipp--schulungsbudget.html');
        exit;
    }
    if(preg_match('/tipps-selfcoaching\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/57/selfcoaching-programm.html');
        exit;
    }
    if(preg_match('/bericht-motivation\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/28/beteiligung-der-mitarbeiter-schafft-motivation.html');
        exit;
    }
    if(preg_match('/verkaufstipp-nachwuchsgruppen\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/51/verkaufstipp-nachwuchsgruppe.html');
        exit;
    }
    if(preg_match('/lit-malik\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/24/f-malik-die-rollende-universitaet.html');
        exit;
    }
    if(preg_match('/dvd-trainer-funktionsweise\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/73/dvd-trainer.html');
        exit;
    }
    if(preg_match('/die-geschaeftsfuehrung-rumi\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/multiplikatoren/die-gruender/manfred-rumi');
        exit;
    }
    if(preg_match('/tipps-entwickeln\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/45/fuehren-ist-coachen.html');
        exit;
    }
    if(preg_match('/die-geschaeftsfuehrung-lohe\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/multiplikatoren/die-gruender/ralf-lohe');
        exit;
    }
    if(preg_match('/dvd-trainer-kosten\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/73/dvd-trainer.html');
        exit;
    }
    if(preg_match('/Aufstand-des-individuums\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv');
        exit;
    }
    if(preg_match('/aktuelles-emotionale-entscheidungen\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/30/entscheidungen-werden-ueberwiegend-emotional-getroffen.html');
        exit;
    }
    if(preg_match('/aktuelles-erfahrungsbericht-rhetorik/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/67/erfahrungsbericht-rhetorik-spezial.html');
        exit;
    }
    if(preg_match('/aktuelles-dvd-trainer\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/73/dvd-trainer.html');
        exit;
    }
    if(preg_match('/seminare-anzeigen\.php\?sid=12/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/persoenliche');
        exit;
    }
    if(preg_match('/aktuelles-pr-marketing\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/72/pr-marketing.html');
        exit;
    }
    if(preg_match('/aktuelles-rhetorik-spezial\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/70/rhetorik-spezial.html');
        exit;
    }
    if(preg_match('/vortragsthemen-fuehrung2\.pdf/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/persoenliche/fuehrungsseminar');
        exit;
    }
    if(preg_match('/lit-full-steam-ahead\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/16/ken-blanchard-jesse-stoner-full-steam-ahead-volle-kraft-voraus-die-kraft-von-visionen.html');
        exit;
    }
    if(preg_match('/Mitarbeiter-die-die-Unternehmensentwicklung/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletter/78/mitarbeiter-die-die-unternehmensentwicklung-blockieren.html');
        exit;
    }
    if(preg_match('/aktuelles-training-fuer-positive-selbstbehauptu/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/33/positive-selbstbehauptung.html');
        exit;
    }
    if(preg_match('/aktuelles-die-zukunft-nicht-verschlafen\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/43/die-zukunft-nicht-verschlafen.html');
        exit;
    }
    if(preg_match('/beteiligung-der-mitarbeiter-schafft-motivation\//', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/28/beteiligung-der-mitarbeiter-schafft-motivation.html');
        exit;
    }
    if(preg_match('/erst-verstehen-dann-verstanden-werden\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/29/erst-verstehen-dann-verstanden-werden.html');
        exit;
    }
    if(preg_match('/Unternehmensvision-aus-der-Sicht-Immanuel/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletter/80/unternehmensvision-aus-der-sicht-immanuel-kants.html');
        exit;
    }
    if(preg_match('/seal-training\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/loesungen/persoenliche/seal-training');
        exit;
    }
    if(preg_match('/gute-mitarbeiter-binden\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/48/gute-mitarbeiter-binden.html');
        exit;
    }
    if(preg_match('/email-briefpapier\.php/', $_SERVER['REQUEST_URI']) > 0)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: http://www.pluspunkt.de/home/newsletterarchiv/46/e-mail-briefpapier.html');
        exit;
    }
?>
