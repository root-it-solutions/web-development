<?php

$result = $_SESSION["check"];

if ($urlOne == 'new')
{

    $_SESSION["check"] = '';
    header("Location: /");
    exit;

}

if ($urlTwo !== '')
{

    $_SESSION["check"][$urlOne] = $urlTwo;

    $page = $urlOne == 4 ? 'result' : $urlOne + 1;

    header("Location: /" . $page . "");
    exit;

}

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow"/>
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="theme-color" content="#225380">

    <link rel="shortcut icon" href="/img/favicon.png" type="image/png">
    <link rel="icon" href="/img/favicon.png" type="image/png">

    <title><?php echo $result; ?> typenchecker by pluspunkt.</title>

    <link rel="stylesheet" href="https://cdn.oceandock.de/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.oceandock.de/css/fontawesome6/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.oceandock.de/bootstrap/select/bootstrap-select.css"/>
    <link rel="stylesheet" href="https://cdn.oceandock.de/fonts/css?family=source-sans-pro">
    <link rel="stylesheet" href="https://cdn.oceandock.de/fonts/css?family=abeezee">
    <link rel="stylesheet" href="/css/frontend.css"/>

</head>

<div class="frame">

    <?php if ($urlOne == 'info') { ?>

        <div class="top">
            <strong>ONLINE CHECK</strong> Welcher Arbeitstyp bist du?
        </div>

        <h2>Der Typen-Checker</h2>
        <div class="questions">

            <p>Mit dem Typen-Checker kannst du schnell erkennen, welche Arbeiten am besten zu dir passen. Wenn du in der
                Lage bist die Aufgaben, die nicht so gut zu dir passen, an andere abzugeben, wirst du weniger Stress und
                daf&uuml;r mehr Freude bei der Arbeit haben. Besonders solltest du das ber&uuml;cksichtigen, wenn du eine neue
                Arbeit aufnimmst. Dabei kannst du im Vorstellungsgespr&auml;ch schon darauf hinwirken, dass die neue Arbeit
                m&ouml;glichst gut zu dir und deinem Charakter passt. Der Typen-Checker gibt dir einen ersten Hinweis,
                welcher Typ du bist.<br><br>
                Entscheide dich bei den folgenden Bereichen (entscheiden, reden, Beziehungen und Arbeit) f&uuml;r nur eine
                der dort aufgef&uuml;hrten Verhaltensweisen. W&auml;hle die Antwort, die dein Handeln am besten beschreibt.
                Nach Best&auml;tigung deiner Eingabe erh&auml;ltst du deine Auswertung.
            </p>

            <a href="/1" title="Check starte" class="button">Zur Frage 1 von 4 <i
                        class="fa-solid fa-arrow-right ml-2"></i></a>


        </div>

    <?php }
    elseif ($urlOne == 'result')
    {
//        var_dump($_SESSION);exit;
        $result = trim($_SESSION["check"]);

        $aDataXXXX = "SELECT * FROM " . DB_ANTWORTEN . " WHERE result='XXXX' ";
        $qDataXXXX = $db->sql_query($aDataXXXX);
        $DataXXXX = $db->sql_fetch_object($qDataXXXX);

        $aData = "SELECT * FROM " . DB_ANTWORTEN . " WHERE result LIKE '%" . trim($_SESSION["check"]) . "%' ";

        $qData = $db->sql_query($aData);
        $Data = $db->sql_fetch_object($qData);

        $answer = $Data->answer != '' ? $Data->answer : $DataXXXX->answer;

        ?>

        <div class="top">
            <strong>ONLINE CHECK</strong> Welcher Arbeitstyp bist du?
        </div>

        <h2>Dein Ergebnis</h2>
        <div class="questions">

            <p><b><?php echo $answer; ?></b></p>

            <hr>

            <div class="small text-muted">Anmerkung: Dieser Typen-Checker ersetzt keine Pr&auml;ferenzanalyse, die auf
                wissenschaftlicher Basis alle Facetten deines Typus wiedergeben kann. Sollest du dein Verhaltensprofil
                genauer beschrieben haben wollen, so kontaktiere uns. Wir k&ouml;nnen dir die g&auml;ngigsten Analysen benennen.
                Hierzu raten wir dir, sofern du wissen m&ouml;chtest, wie du dich in einem Team am besten einbringen kannst
                oder worauf du aufgrund deines Charakters beim F&uuml;hren von Mitarbeitenden achten solltest.
            </div>

            <a href="/new" class="btn btn-light delete"><i class="fa-solid fa-arrow-left mr-1"></i>Check neu starten</a>

        </div>

    <?php }
    elseif ($urlOne === 'verhalten-des-menschen-der-rote-typus')
    {
        ?>

        <div class="top">
            <strong>ONLINE CHECK</strong> Welcher Arbeitstyp bist du?
        </div>

        <h2>Verhalten des Menschen</h2>
        <div class="questions">

            <p><b>Der rote Typus</b></p>

            <hr>

            <div class="small text-muted">Sicherlich kennst du Menschen, die eine dominante Ausstrahlung haben. Du erkennst sie daran, dass sie z.B. kurz angebunden sind und gerne direkt zur Sache kommen, nicht so gerne &uuml;ber Pers&ouml;nliches sprechen, Entscheidungen schnell, gerne auch risikoreich treffen, sich &uuml;berwiegend von Fakten leiten lassen und in ihrer Wortwahl nicht sehr zimperlich sind. Diese Menschen haben einen hohen Grad an Dominanz und werden in Analysen mit der Farbe &quot;rot&quot; gekennzeichnet.
                <br /><br />
                Auf andere Menschen wirkt dieser Mensch oft ungeduldig (immer vorw&auml;rts dr&auml;ngend), Respekt einfl&ouml;&szlig;end, effektiv, sachlich aber auch manchmal einsch&uuml;chternd.
                <br /><br />
                Solltest du dich in dieser Beschreibung wiederfinden, so verh&auml;ltst du dich in deinem Verhalten anderen gegen&uuml;ber wie ein Direktor. Solltest du auf Menschen sto&szlig;en, die weitaus weniger dominant sind, also genau das Gegen&uuml;berliegende Profil haben, so empfehlen sich hier folgende Verhaltensweisen:
                <br /><br />
                Manche Menschen m&uuml;ssen bei einem Gespr&auml;ch erst "ankommen". R&auml;ume hier etwas Zeit f&uuml;r einen Smalltalk ein. Habe Geduld, wenn du auf Fragen nicht direkt eine Antwort bekommst. Besser noch du fragst, wann du mit einer Antwort auf deine Frage rechnen kannst. Gib ihnen Unterst&uuml;tzung bei Entscheidungen ohne sie zu bevormunden. Hilf ihnen mit guten Argumenten anstehende Ver&auml;nderungen zu akzeptieren. Und achte auf die nonverbale Kommunikation. Sprich an, wenn du nicht ganz sicher bist, dass dein Gegen&uuml;ber mit dir einer Meinung ist.
            </div>

            <a href="/new" class="btn btn-light delete"><i class="fa-solid fa-arrow-left mr-1"></i>Check neu starten</a>

        </div>

        <?php
    }
    elseif ($urlOne === 'verhalten-des-menschen-der-gruene-typus')
    {
        ?>

        <div class="top">
            <strong>ONLINE CHECK</strong> Welcher Arbeitstyp bist du?
        </div>

        <h2>Verhalten des Menschen</h2>
        <div class="questions">

            <p><b>Der gr&uuml;ne Typus</b></p>

            <hr>

            <div class="small text-muted">Der gr&uuml;ne Typus ist der perfekte Zuh&ouml;rer, hat viel Einf&uuml;hlungsverm&ouml;gen und wird dir immer helfen, wenn du Hilfe ben&ouml;tigst. Er nimmt R&uuml;cksicht auf andere und steht meist im Hintergrund. Anerkennung tut ihm gut und er sch&auml;tzt es, wenn ihm bei schwierigen Aufgaben oder Ver&auml;nderungen Unterst&uuml;tzung gew&auml;hrt wird.
                <br /><br />
                Am liebsten unterst&uuml;tzt dieser Menschenfreund andere. Diese Menschen haben einen hohen Grad an Stetigkeit und werden in Analysen mit der Farbe "gr&uuml;n" gekennzeichnet.
                <br /><br />
                Solltest du dich in dieser Beschreibung wiederfinden, so verh&auml;ltst du dich in deinem Verhalten anderen gegen&uuml;ber wie ein Direktor. Solltest du auf Menschen sto&szlig;en, die weitaus weniger dominant sind, also genau das Gegen&uuml;berliegende Profil haben, so empfehlen sich hier folgende Verhaltensweisen:
                <br /><br />
                Versuche m&ouml;glichst ohne Smalltalk auszukommen. Bereite dich auf die Gespr&auml;che gut vor. Vor allem solltest du Vorschl&auml;ge f&uuml;r weitere Handlungsweisen haben, die du auch begr&uuml;nden kannst. Vermeide, um den hei&szlig;en Brei zu reden, denn dein Gegen&uuml;ber m&ouml;chte sich entscheiden k&ouml;nnen. Und erbitte Zeit zum Nachdenken, wenn du auf eine gestellte Frage nicht spontan antworten kannst, ohne unsicher zu sein.
            </div>

            <a href="/new" class="btn btn-light delete"><i class="fa-solid fa-arrow-left mr-1"></i>Check neu starten</a>

        </div>

        <?php
    }
    elseif ($urlOne === 'verhalten-des-menschen-der-gelbe-typus')
    {
        ?>

        <div class="top">
            <strong>ONLINE CHECK</strong> Welcher Arbeitstyp bist du?
        </div>

        <h2>Verhalten des Menschen</h2>
        <div class="questions">

            <p><b>Der gelbe Typus</b></p>

            <hr>

            <div class="small text-muted">Dieser Typus hat viele Kontakte und liebt es unter Menschen zu sein. Er redet gerne und viel, ist eloquent und schlagfertig. Als Unterhalter ist er beliebt und wird gerne eingeladen. In seiner Kreativit&auml;t entwickelt er gerne Ideen, auf die andere nicht gekommen w&auml;ren. Wenn er zu viel redet, kann er andere auch nerven. Er h&ouml;rt nicht immer gut zu und ist oberfl&auml;chlich. Zuweilen wirkt er auch chaotisch. Dies, zumal er manchmal vergisst, seine Aufgaben zu Ende zu bringen. Ihnen wird die Farbe gelb zugewiesen.
                <br /><br />
                Wenn dies bei deinem Verhalten so &auml;hnlich ist, solltest du bei den Menschen, die eindeutig ein anderes Verhaltensprofil haben, auf folgendes achten:
                <br /><br />
                Konzentriere dich auf das Zuh&ouml;ren. So kannst du wertvolle Informationen aufnehmen, die dich davor bewahren k&ouml;nnen, falsche Schl&uuml;sse zu ziehen. Helfe durch geeignete Fragen den stilleren Menschen dazu, sich ebenfalls zu erkl&auml;ren, aber zwinge sie dich dazu, wenn sie mit ihrem Denkprozess noch nicht abgeschlossen haben. Sehe in den stilleren Menschen deine Partner, die die von dir angeschobenen Ideen gerne und gewissenhaft zu Ende f&uuml;hren. Sie helfen dir, deine Schw&auml;chen auszugleichen.
            </div>

            <a href="/new" class="btn btn-light delete"><i class="fa-solid fa-arrow-left mr-1"></i>Check neu starten</a>

        </div>

        <?php
    }
    elseif ($urlOne === 'verhalten-des-menschen-der-blaue-typus')
    {
        ?>

        <div class="top">
            <strong>ONLINE CHECK</strong> Welcher Arbeitstyp bist du?
        </div>

        <h2>Verhalten des Menschen</h2>
        <div class="questions">

            <p><b>Der blaue Typus</b></p>

            <hr>

            <div class="small text-muted">In vielen Aufgaben kommt es auf Genauigkeit und Details an. Der gewissenhafte Typus - mit der Farbe blau gekennzeichnet - kann diese Aufgaben am besten bew&auml;ltigen und geht sie auch diszipliniert an. Er zeigt wenig Emotionen, hat klare &uuml;berzeugungen und kann perfekt analysieren. Da er den Wunsch hat, den Dingen immer auf den Grund zu gehen, kann es vorkommen, dass er zu langsam f&uuml;r andere ist oder es f&uuml;r diese in seiner Genauigkeit &uuml;bertreibt. Eigene Fehler &auml;rgern ihn besonders. Gerne arbeitet er allein oder in einem sehr kleinen Team.
                <br /><br />
                Erkennst du dich wieder? Dann achte auf folgende Hinweise:
                <br /><br />
                Stimme mit deinen Teammitgliedern und Vorgesetzten ab, bis wann deine Aufgaben zu erf&uuml;llen sind. Solltest du damit nicht auskommen, bitte rechtzeitig um eine Fristverl&auml;ngerung. Lass dir bei gr&ouml;&szlig;eren Entscheidungen ruhig helfen. Du wirst dich dann sicherer f&uuml;hlen, und wenn du es richtig angehst, wird sich dein Ratgeber geehrt f&uuml;hlen, dir einen Dienst erwiesen zu haben. Und dein Image nimmt keinen Schaden. Lerne im Umgang mit deinen Mitmenschen offener zu werden und auch Gef&uuml;hle zu zeigen. Auch wenn dir das am Anfang etwas unangenehm ist, wirst du feststellen, dass du so besser Beziehungen pflegen kannst und von Mal zu Mal mehr Selbstvertrauen erlangst.
            </div>

            <a href="/new" class="btn btn-light delete"><i class="fa-solid fa-arrow-left mr-1"></i>Check neu starten</a>

        </div>

        <?php
    }
    elseif ($urlOne === 'blauer-und-gelber-typus-synergien-und-konflikte')
    {
        ?>

        <div class="top">
            <strong>ONLINE CHECK</strong> Welcher Arbeitstyp bist du?
        </div>

        <h2>Blauer und gelber Typus</h2>
        <div class="questions">

            <p><b>Synergien und Konflikte</b></p>

            <hr>

            <div class="small text-muted">Grunds&auml;tzlich ist das Zusammenarbeiten mit Menschen, die ganz anders als du ticken, nicht so einfach. Die erste Reaktion, die wir versp&uuml;ren, ist, diesen Menschen nach M&ouml;glichkeit aus dem Weg zu gehen. Da sie aber deine Verhaltensweisen, die deinem Erfolg im Wege stehen, ausgleichen k&ouml;nnen, solltest du die Zusammenarbeit immer anstreben und daraus im Umgang miteinander lernen.
                <br /><br />
                Gehen wir mal davon aus, dass der blaue Typus der Chef und sein Mitarbeitender der gelbe Typus ist. Dann wird er sich zun&auml;chst an der Oberfl&auml;chlichkeit des gelben Typus st&ouml;ren. Auch die Tatsache, dass er nicht immer gut zuh&ouml;rt und mit der Zeit sehr eigenwillig umgeht (er kommt gerne mal zu sp&auml;t) behagt dem Blauen nicht. Wenn er sich jedoch auf die St&auml;rken des gelben Typus konzentriert, kann er folgenden Nutzen in der Zusammenarbeit erzielen.
                <br /><br />
                Liegt ein Problem vor, das sich scheinbar nicht l&ouml;sen l&auml;sst, so kann die Kreativit&auml;t des gelben Typus m&ouml;glicherweise helfen, einen Ausweg zu finden. Muss eine Idee oder Ma&szlig;nahme innerhalb oder au&szlig;erhalb der Abteilung bzw. Firma vertreten werden, kann man die verk&auml;uferischen F&auml;higkeiten und die Begeisterungsf&auml;higkeit des Gelben nutzen, bei den anderen Menschen die Idee oder Ma&szlig;nahme zu verkaufen. Mit Eloquenz und der F&auml;higkeit auf Menschen zuzugehen, h&auml;lt er gerne Teams zusammen und sorgt f&uuml;r eine gute Atmosph&auml;re. Auch kann er seinem blauen Chef dabei helfen, in dessen sachlichen &uuml;berlegungen auch die Sensibilit&auml;t der Menschen zu ber&uuml;cksichtigen. Gerne hilft er dabei Formulierungen zu finden, die neben der Sachlichkeit auch den Menschen richtig ansprechen.
                <br /><br />
                F&uuml;r den Fall, dass der gelbe Typus der Chef ist, wird er den blauen Typus als langsam, &uuml;bergenau und verschlossen wahrnehmen. Auch wenn das genau der Typus ist, mit dem der Gelbe am wenigsten gerne zusammenarbeitet, so kann die Zusammenarbeit folgende Vorteile bringen.
                <br /><br />
                Alle Ideen, die der gelbe Typus - kreativ wie er ist - entwickelt hat, kann der blaue Typus gewissenhaft abarbeiten. Er kann den Gelben auch dabei beraten, wenn die Idee zwar kreativ ist, es aber zun&auml;chst an Geld und Menschen fehlt, das Vorhaben zu realisieren. M&uuml;ssen Entscheidungen gef&auml;llt werden, wird die Oberfl&auml;chlichkeit des gelben Typus durch die Analysef&auml;higkeit des Blauen perfekt ausgeglichen, und es k&ouml;nnen dann abgesicherte Entscheidungen getroffen werden. Voraussetzung ist allerdings, dass der blaue Typus ausreichend Zeit f&uuml;r seine Analyse bekommt.
                <br /><br />
                Die Zusammenarbeit dieser beiden Typen funktioniert nicht nur im &uuml;ber-/ Unterstellungsverh&auml;ltnis sondern auch auf Kollegenebene. So ist der blaue Typus im Service f&uuml;r genaue Arbeiten (Ordnung, Sauberkeit, Bestellung aufnehmen, Geldverkehr, HACCP-Ma&szlig;nahmen und -Listen, etc.) besser eingesetzt als der gelbe Typus. Daf&uuml;r kann der besser mit den G&auml;sten reden und ihnen eine angenehme Atmosph&auml;re bieten (Smalltalk, Bedienung, Erkl&auml;rungen der Speisen, Verkaufen aktueller Angebote, Atmosph&auml;re auflockern, etc.).
            </div>

            <a href="/new" class="btn btn-light delete"><i class="fa-solid fa-arrow-left mr-1"></i>Check neu starten</a>

        </div>

        <?php
    }
    elseif ($urlOne === 'roter-und-gruene-typus-ein-perfektes-team')
    {
        ?>

        <div class="top">
            <strong>ONLINE CHECK</strong> Welcher Arbeitstyp bist du?
        </div>

        <h2>Roter und gr&uuml;ner Typus</h2>
        <div class="questions">

            <p><b>Ein perfektes Team</b></p>

            <hr>

            <div class="small text-muted">Der rote und gr&uuml;ne Typus m&ouml;gen sich zun&auml;chst aufgrund ihrer Unterschiedlichkeit auch nicht auf Anhieb. Aber zusammen k&ouml;nnen sie zu einem perfekten Team werden.
                <br /><br />
                Der bessere Kommunikator ist der gr&uuml;ne Typus, da er sich auf die Menschen einstellt und vermeidet f&uuml;r die Gespr&auml;chspartner zu schnell zu sein und mit seinem Einf&uuml;hlungsverm&ouml;gen auch die richtigen Worte w&auml;hlen wird. Er kann den Roten darin unterst&uuml;tzen, die Wirkung von Entscheidungen auf die betroffenen Menschen zu ber&uuml;cksichtigen, um dann z.B. durch Beteiligung der betroffenen Teammitglieder Widerstand bei einer notwendigen Ver&auml;nderung zu vermeiden.
                <br /><br />
                M&uuml;ssen hingegen harte und f&uuml;r Andere unangenehme Ma&szlig;nahmen ergriffen werden, f&uuml;hlt sich der gr&uuml;ne Typus schlecht und w&uuml;rde diese Aufgabe am liebsten auf die lange Bank schieben. Hier kann der rote Typus mit seiner Dominanz helfen, indem er diese Aufgabe l&ouml;st. Auch kann er helfen, schnelle Entscheidungen herbeizuf&uuml;hren. Vor der Neukundenakquisition hat er auch keine Angst vor der m&ouml;glichen Zur&uuml;ckweisung. Der gr&uuml;ne Typus kann sich dann um die Beziehungspflege k&uuml;mmern. In dieser Aufgabe f&uuml;hlt er sich wohl.
            </div>

            <a href="/new" class="btn btn-light delete"><i class="fa-solid fa-arrow-left mr-1"></i>Check neu starten</a>

        </div>

        <?php
    }
    elseif ($urlOne != '')
    {

        $array_pages[1] = 'entscheiden';
        $array_pages[2] = 'reden';
        $array_pages[3] = 'Beziehungen';
        $array_pages[4] = 'Arbeit';

        $area = $array_pages[$urlOne];

        ?>

        <div class="top">

            <strong>ONLINE CHECK</strong> Welcher Arbeitstyp bist du?
        </div>

        <h2>0<?php echo $urlOne; ?>. <?php echo $array_pages[$urlOne]; ?></h2>
        <div class="questions">

            <div class="row">

                <?php
                $aDaten = "SELECT * FROM " . DB_FRAGEN . " WHERE area='" . $area . "' ORDER BY id ASC";
                $qDaten = $db->sql_query($aDaten);
                $rDaten = $db->sql_num_rows($qDaten);
                while ($Daten = $db->sql_fetch_object($qDaten))
                {
                    {
                        echo '<div class="col-12 mb-2"><a href="/' . $urlOne . '/' . $Daten->result . '" class="btn btn-light" title="' . $Daten->question . '"><i class="fa-sharp fa-solid fa-square-chevron-right"></i><div class="q">' . $Daten->question . '</div></a></div>';
                    }
                }
                ?>
            </div>

            <div class="small text-muted mt-3">Frage <?php echo $urlOne; ?> von 4</div>

        </div>

    <?php } else { ?>

        <div class="home">
            <div class="homeInnen"></div>
            <div class="titleTop">ONLINE CHECK</div>
            <div class="titleBottom">Welcher Arbeitstyp bist du?</div>
            <div class="content">
                <h1>Sei gl&uuml;cklich in deinemBeruf! Und zeig was du kannst!</h1>
                <p>Keine Kosten! Keine Datenangabe! Einfach checken!<br/>Beantworte 4 Fragen und sieh, welcher
                    Verhaltens-Typ du bist.</p>


                <a href="/info" title="Check starte" class="button start">Check starten <i
                            class="fa-solid fa-arrow-right ml-2"></i></a>

            </div>


        </div>

    <?php } ?>

    <?php // echo '<pre>'; print_r($_SESSION["check"]); 	echo '</pre>'; ?>

</div>

<script src="https://cdn.oceandock.de/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdn.oceandock.de/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.oceandock.de/bootstrap/select/bootstrap-select.min.js"></script>

</body>
</html>
