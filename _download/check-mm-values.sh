#!/bin/sh

# (c) 2025
# Ingolf Steinhardt <info@e-spin.de>
# Version 1.0

# ----------------------------------------
# Konfiguration
# ----------------------------------------

# Doctrine-Aufruf (ggf. PHP-Aufruf anpassen)
DOCTRINE_BIN="php vendor/bin/contao-console doctrine:query:sql"

# Tabellenliste: <tabelle>:<attributsspalte>
TABLES=$(cat <<'EOF'
tl_metamodel_rating:aid
tl_metamodel_tablemulti:att_id
tl_metamodel_tabletext:att_id
tl_metamodel_tag_relation:att_id
tl_metamodel_translatedcheckbox:att_id
tl_metamodel_translatedlongblob:att_id
tl_metamodel_translatedlongtext:att_id
tl_metamodel_translatedtablemulti:att_id
tl_metamodel_translatedtabletext:att_id
tl_metamodel_translatedtext:att_id
tl_metamodel_translatedurl:att_id
EOF
)

# ----------------------------------------
# Script
# ----------------------------------------

ACTION="$1"

if [ -z "$ACTION" ]; then
    echo "Bitte Parameter angeben: show oder delete"
    exit 1
fi

echo "$TABLES" | while read ENTRY; do
    # Leere Zeilen überspringen
    [ -z "$ENTRY" ] && continue

    TABLE=$(echo "$ENTRY" | cut -d: -f1)
    COL=$(echo "$ENTRY" | cut -d: -f2)

    case "$ACTION" in
        show)
            SQL="SELECT t.*
FROM ${TABLE} AS t
LEFT JOIN tl_metamodel_attribute AS att ON t.${COL} = att.id
WHERE att.id IS NULL;"
            echo ">>> Tabelle: $TABLE (Spalte: $COL)"
            $DOCTRINE_BIN "$SQL"
            ;;
        delete)
            SHOW_SQL="SELECT COUNT(*) AS cnt
FROM ${TABLE} AS t
LEFT JOIN tl_metamodel_attribute AS att ON t.${COL} = att.id
WHERE att.id IS NULL;"
            DELETE_SQL="DELETE t.*
FROM ${TABLE} AS t
LEFT JOIN tl_metamodel_attribute AS att ON t.${COL} = att.id
WHERE att.id IS NULL;"

            echo ">>> Tabelle: $TABLE (Spalte: $COL)"

            # Anzahl ungültiger Datensätze ermitteln
            CNT=$($DOCTRINE_BIN "$SHOW_SQL" | tr -d ' ' | grep -Eo '[0-9]+')

            if [ "$CNT" -eq 0 ]; then
                echo "✅ Keine ungültigen Datensätze in $TABLE – übersprungen"
                continue
            fi

            echo "Ungültige Datensätze:"
            $DOCTRINE_BIN "$SHOW_SQL"

            printf "Möchtest du die ungültigen Einträge in %s löschen? (j/n) " "$TABLE"
            read CONFIRM </dev/tty
            if [ "$CONFIRM" = "j" ] || [ "$CONFIRM" = "J" ]; then
                $DOCTRINE_BIN "$DELETE_SQL"
                echo "✅ Gelöscht in $TABLE"
            else
                echo "❌ Übersprungen $TABLE"
            fi
            ;;
        *)
            echo "Ungültiger Parameter: $ACTION"
            echo "Verwendung: $0 {show|delete}"
            exit 1
            ;;
    esac
done
