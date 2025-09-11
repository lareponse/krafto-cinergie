<?php

namespace App\Models;

class Export
{

    public static function professionals(): string
    {
        return 'SELECT 
                    p.id,
                    p.lastname as nom,
                    p.firstname as prenom,
                    GROUP_CONCAT(DISTINCT pt.label SEPARATOR ",") as categories,
                    p.street as adresse,
                    p.zip as cp,
                    p.city as ville,
                    p.country as pays,
                    p.tel,
                    p.fax,
                    p.gsm as mobile,
                    p.email,
                    p.url as site,
                    p.gender as genre,
                    p.birth as datenaiss,
                    p.death as datedeces,
                    p.leg_maj as maj
                FROM professional p
                LEFT JOIN professional_praxis pp ON p.id = pp.professional_id
                LEFT JOIN tag pt ON pp.tag_id = pt.id
                GROUP BY p.id;';
    }

    public static function organisations(): string
    {
        return 'SELECT 
                    o.id,
                    o.label as nom,
                    o.abbrev as abreviation,
                    GROUP_CONCAT(DISTINCT pt.label SEPARATOR ",") as categories,

                    o.street as adresse,
                    o.zip as cp,
                    o.city as ville,
                    o.country as pays,
                    o.tel,
                    o.fax,
                    o.gsm as mobile,
                    o.email,
                    o.url as site,
                    o.TVA as tva,
                    o.numero_entreprise,
                    o.BIC,
                    o.IBAN,
                    o.isPartner,
                    o.legacy_maj as maj
                FROM organisation o
                LEFT JOIN organisation_praxis op ON o.id = op.organisation_id
                LEFT JOIN tag pt ON op.tag_id = pt.id
                GROUP BY o.id;';
    }

    public static function movies(): string
    {
        return 'SELECT 
                    m.*,
                    GROUP_CONCAT(DISTINCT CONCAT(p.firstname, " ", p.lastname, " (", pt.label, ")") SEPARATOR " | ") as professionals,
                    GROUP_CONCAT(DISTINCT CONCAT(o.label, " (", ot.label, ")") SEPARATOR " | ") as organisations,
                    GROUP_CONCAT(DISTINCT a.label SEPARATOR " | ") as articles
                FROM movie m
                LEFT JOIN movie_professional mp ON m.id = mp.movie_id
                LEFT JOIN professional p ON mp.professional_id = p.id
                LEFT JOIN tag pt ON mp.praxis_id = pt.id
                LEFT JOIN movie_organisation mo ON m.id = mo.movie_id
                LEFT JOIN organisation o ON mo.organisation_id = o.id
                LEFT JOIN tag ot ON mo.praxis_id = ot.id
                LEFT JOIN article_movie am ON m.id = am.movie_id
                LEFT JOIN article a ON am.article_id = a.id
                GROUP BY m.id';
    }
}
