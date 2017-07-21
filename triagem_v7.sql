copy (
select distinct on (node) * ,
case
when kpi = 'OK' and omr = 'OK' and "TX/OMR" = 'OK' and otm = 'OK' and capacity = 'OK' AND "PLAN/ENG RF" = 'OK' then 'NORMAL' 
when omr = 'NOK' then 'OMR'
WHEN "TX/OMR" = 'NOK' then 'TX/OMR'
WHEN otm = 'NOK' THEN 'OTM'
WHEN capacity = 'NOK' and "NP Action Found?" = 'No' then 'CAP'
WHEN status_board = 'NOK' and "NP Action Found?" = 'No' then 'PLAN/ENG RF'
WHEN capacity = 'NOK' and "NP Action Found?" = 'Yes' then 'IMP'
else 'ANALYSIS'
end as area


-- when (u.code_utilization >= 70::real or u.dlpower_utilization >= 70::real or u.user_fach_utilization >= 70::real or u.rach_utilization >= 70::real or u.pch_utilization >= 60::real or u.cnbap_utilization >= 60::real or u.dlce_utilization >= 70::real or u.ulce_utilization >= 70::real) AND pn.site is null then 'CAP'
-- when i.status = 'NOK' and pn.site is null THEN 'PLAN/ENG RF'
-- when (u.code_utilization >= 70::real or u.dlpower_utilization >= 70::real or u.user_fach_utilization >= 70::real or u.rach_utilization >= 70::real or u.pch_utilization >= 60::real or u.cnbap_utilization >= 60::real or u.dlce_utilization >= 70::real or u.ulce_utilization >= 70::real or i.status = 'NOK') AND pn.site is not null then 'IMP'
-- when (n.availability>=99.5) AND (t.tx_integrity >= 90) and ((e.ee <= 22 or e.balanced = 'OK') and (o.count = 0 or o.count is null) and m.rtwp <= -90 and (b.status = 'OK')) and (u.code_utilization < 70::real and u.dlpower_utilization < 70::real and u.user_fach_utilization < 70::real and u.rach_utilization < 70::real and u.pch_utilization < 60::real and u.cnbap_utilization < 60::real and u.dlce_utilization < 70::real and u.ulce_utilization < 70::real) and i.status = 'OK' and i.status = 'OK' AND (qda_ps_f2h >= 90 and qdr_ps >=95  and retention_ps = 100 and n.availability>=99.5 and qda_cs >=92 and qdr_cs>=92 and m.rtwp <=-90) then 'NORMAL'
-- else 'ANALYSIS'
-- end as area

from
(SELECT n.year, n.week, n.region, n.rnc, n.nodebname, n.node, qda_cs, 
       qda_ps_f2h as qda_hs, qdr_cs, qdr_ps qdr_ps, throughput, n.availability, retention_cs, 
       retention_ps, hsdpa_users_ratio, m.rtwp, nqi_cs, nqi_ps_f2h nqi_hs,
case when (qda_ps_f2h >= 90 and qdr_ps >=95  and retention_ps = 100 and n.availability>=99.5 and qda_cs >=92 and qdr_cs>=92 and m.rtwp <=-90 and retention_cs >=99.5 and hsdpa_users_ratio>99.5 and throughput > 92) then 'OK' else 'NOK' end as kpi,  
i.wbbp_total,
CASE when n.availability>=99.5 then 'OK' ELSE 'NOK' end as status_availability,
alarm.alarmname as "Uncleared Alarms",
alarm.tipo as Note,
case when (n.availability<99.5) or alarm.nodeb is not null then 'NOK' else 'OK' end omr,
t.transt as tx_type,
t.ping_meandelay,
t.ping_meanjitter,
t.ping_meanlost,
t.vs_iub_flowctrol_dl_dropnum_lgcport1,t.vs_iub_flowctrol_ul_dropnum_lgcport1,t.vs_iub_flowctrol_dl_congtime_lgcport1,t.vs_iub_flowctrol_ul_congtime_lgcport1,
t.atm_dl_utilization,t.atm_ul_utilization,	
t.tx_integrity,
null as note,
case when (t.tx_integrity < 92) then 'NOK' else 'OK' end "TX/OMR",
case when (e.ee > 22 and e.balanced = 'NOK') then 'NOK' else 'OK' end as ee_balanced,
case when (o.count > 0 and o.count is not null) then 'NOK' else 'OK' end as no_overshooter,
o.count as covered_sites_count, 
o.covered_sites, 
coalesce(b.status,'OK') as parameter_check,
b.mo_out as mo_out,
case when ((e.ee > 22 and e.balanced = 'NOK') or (o.count > 0 and o.count is not null) or m.rtwp > -90 or (b.status = 'NOK')) then 'NOK' else 'OK' end otm,
e.ee as ee,
null as load,
 u.code_utilization, 
 u.dlpower_utilization,
 u.user_fach_utilization,
 u.rach_utilization,
 u.pch_utilization,
 u.cnbap_utilization,
 u.dlce_utilization,
 u.ulce_utilization,
case when (u.code_utilization >= 70::real or u.dlpower_utilization >= 70::real or u.user_fach_utilization >= 70::real or u.rach_utilization >= 70::real or u.pch_utilization >= 60::real or u.cnbap_utilization >= 60::real or u.dlce_utilization >= 70::real or u.ulce_utilization >= 70::real) then 'NOK' else 'OK' end as capacity,
i.board_found,
i.status as status_board,
case when pn.site is null then 'No' else 'Yes' end as "NP Action Found?",
pn.atividade as "NP Solution",
pn.solucao as "Nota",
case when (u.code_utilization >= 70::real or u.dlpower_utilization >= 70::real or u.user_fach_utilization >= 70::real or u.rach_utilization >= 70::real or u.pch_utilization >= 60::real or u.cnbap_utilization >= 60::real or u.dlce_utilization >= 70::real or u.ulce_utilization >= 70::real) and pn.site is null then 'NOK'
WHEN i.status = 'NOK' and pn.site is null then 'NOK'
else 'OK' end as "PLAN/ENG RF"
--,
-- CASE when (n.availability<99.5) then 'OMR'
-- when ((t.tx_integrity < 90)) then 'TX'
-- when ((e.ee > 22 and e.balanced = 'NOK') or (o.count > 0 and o.count is not null) or m.rtwp > -90 or (b.status = 'NOK')) then 'OTM'
-- when (u.code_utilization >= 70::real or u.dlpower_utilization >= 70::real or u.user_fach_utilization >= 70::real or u.rach_utilization >= 70::real or u.pch_utilization >= 60::real or u.cnbap_utilization >= 60::real or u.dlce_utilization >= 70::real or u.ulce_utilization >= 70::real) AND pn.site is null then 'CAP'
-- when i.status = 'NOK' and pn.site is null THEN 'PLAN/ENG RF'
-- when (u.code_utilization >= 70::real or u.dlpower_utilization >= 70::real or u.user_fach_utilization >= 70::real or u.rach_utilization >= 70::real or u.pch_utilization >= 60::real or u.cnbap_utilization >= 60::real or u.dlce_utilization >= 70::real or u.ulce_utilization >= 70::real or i.status = 'NOK') AND pn.site is not null then 'IMP'
-- when (n.availability>=99.5) AND (t.tx_integrity >= 90) and ((e.ee <= 22 or e.balanced = 'OK') and (o.count = 0 or o.count is null) and m.rtwp <= -90 and (b.status = 'OK')) and (u.code_utilization < 70::real and u.dlpower_utilization < 70::real and u.user_fach_utilization < 70::real and u.rach_utilization < 70::real and u.pch_utilization < 60::real and u.cnbap_utilization < 60::real and u.dlce_utilization < 70::real and u.ulce_utilization < 70::real) and i.status = 'OK' and i.status = 'OK' AND (qda_ps_f2h >= 90 and qdr_ps >=95  and retention_ps = 100 and n.availability>=99.5 and qda_cs >=92 and qdr_cs>=92 and m.rtwp <=-90) then 'NORMAL'
-- else 'ANALYSIS'
-- end as area
FROM umts_kpi.vw_nqi_weekly_cell_2 n 
left join umts_capacity.vw_utilization_weekly u on n.rnc=u.rnc and n.cellid = u.cellid and n.year = u.year and n.week = u.week
left join w28_ee e on n.rnc = e.rnc and n.cellid = e.cellid
left join common_gis.cell_overshooters_v2 o on n.rnc = o.rnc and n.cellid = o.cellid and n.year = o.year and n.week = o.week
left join umts_kpi.vw_main_kpis_cell_rate_weekly m on n.rnc = m.rnc and n.cellid = m.cellid and n.year = m.year and n.week = m.week
--left join umts_kpi.vw_tx_integrity_ani t on n.nodeb = t.nodeb_norm and n.year = t.year and n.week = t.week
left join (select *,get_nodeb_name(node, 'nodeb') as nodeb_norm  from w28_tx) t on n.nodeb = t.nodeb_norm and n.year = t.year and n.week = t.week
left join (select distinct on (nodebname_normalized) * from umts_inventory.board_status_m2k) i on n.nodeb = i.nodebname_normalized
left join (select nodeb,STRING_AGG(alarmname::text, ',' order by occurrencetime) as alarmname,STRING_AGG(netype::text, ',' order by occurrencetime) netype,STRING_AGG(type::text, ',' order by occurrencetime) tipo,STRING_AGG(severity::text, ',' order by occurrencetime) severity,STRING_AGG(occurrencetime::text, ',' order by occurrencetime) occurrencetime from (select distinct on (nodeb,alarmname) get_nodeb_name(alarm_source, 'nodeb'::text) AS nodeb,* from alarm.alarm_log where severity in ('Major','Critical') and locationinformation not like '%eNodeB%' and locationinformation not like 'X2%' and locationinformation not like 'S1%') alarm group by nodeb) alarm on n.nodeb = alarm.nodeb
left join (select site,STRING_AGG(semana_publicacao::text, ',' order by semana_publicacao) AS semana_publicacao, STRING_AGG(tipo_solucao::text, ',' order by semana_publicacao) AS tipo_solucao, STRING_AGG(atividade::text, ',' order by semana_publicacao) AS atividade, STRING_AGG(objetivo::text, ',' order by semana_publicacao) AS objetivo,  STRING_AGG(comentario_solucao::text, ',' order by semana_publicacao) AS solucao  from pn  inner join pn_umts on pn.atividade = pn_umts.solucao  where tecnologia = '3G' group by site) pn on right(n.nodeb,7) = pn.site
left join (select node,element_id,status,
STRING_AGG(mo::text, ',' order by mo) AS mo_out
from
(select distinct node,element_id,mo,status
--from umts_baseline.baseline_audit('baseline') where status = 'NOK' and mo not in ('UCELLLICENSE')
from umts_baseline.consistency_check_hist where status = 'NOK' and mo not in ('UCELLLICENSE') and baseline_date = '2017-07-05'
) t
group by node,element_id,status) b on n.rnc=b.node and n.cellid::text = b.element_id
  where n.year = 2017 and n.week = 28) t1

) to '/home/postgres/dump/w28_triagev.csv' delimiter ';' csv header