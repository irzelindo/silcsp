--
-- PostgreSQL database dump
--

-- Dumped from database version 12.5
-- Dumped by pg_dump version 14.11 (Ubuntu 14.11-1.pgdg22.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: corregir(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.corregir() RETURNS void
    LANGUAGE plpgsql
    AS $$
DECLARE
    reg          RECORD;
    cur_estudios CURSOR FOR 
	select t.nordentra, r.nroestudio
	from ordtrabajo t, estrealizar r, resultados re
	where t.nordentra   = r.nordentra
	and   (select count(*) from resultados where nordentra = t.nordentra) = 1
	and   (re.nroestudio != r.nroestudio
			and  re.nordentra  = r.nordentra
		  );
BEGIN
   FOR reg IN cur_estudios LOOP
    
	update resultados
	set nroestudio = reg.nroestudio
	where nordentra  =  reg.nordentra;
 
	
    RAISE NOTICE ' PROCESANDO  %', reg.nordentra;
   END LOOP;
   RETURN;
END
$$;


ALTER FUNCTION public.corregir() OWNER TO postgres;

--
-- Name: update_resultados_from_ingenius(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.update_resultados_from_ingenius() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
declare
    idEstudio VARCHAR(10);
    idDetermina VARCHAR(10);
    idOrden INTEGER;
    idNroMuestra iNTEGER;
    lResultado VARCHAR(100);
BEGIN
    -- Extracting the value from universal_test_id
    SELECT coddetermina, codestudio
      INTO idDetermina, idEstudio
      FROM determinaciones_equipos
     WHERE coddetermina_equipo LIKE '%' || SUBSTRING(NEW.universal_test_id FROM 4 FOR POSITION('^' IN SUBSTRING(NEW.universal_test_id FROM 4)) - 1) || '%';

    -- Extracting data from nro_orden
    idNroMuestra := CAST ( SUBSTRING(NEW.nro_orden FROM 4) as integer);
     
     SELECT nordentra
       INTO idOrden
       FROM estrealizar
      WHERE nromuestra = idNroMuestra;
     
    
    --idOrden := CAST ( SUBSTRING(NEW.nro_orden FROM 4) as integer);
    lResultado := new.component2;
   
    -- Updating the resultados table
    UPDATE resultados
       SET resultado = lResultado
     WHERE coddetermina = idDetermina
       AND codestudio = idEstudio
       AND nordentra = idOrden;

    RETURN NEW;
END;
$$;


ALTER FUNCTION public.update_resultados_from_ingenius() OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: alertas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.alertas (
    nromsg numeric(15,0) NOT NULL,
    codproceso character varying(10),
    texto character varying(250),
    fechaproc date,
    estado numeric(1,0)
);


ALTER TABLE public.alertas OWNER TO postgres;

--
-- Name: antibiogramas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.antibiogramas (
    codantibiogr character varying(10) NOT NULL,
    nomantibiogr character varying(100),
    codestudiobio character varying(10)
);


ALTER TABLE public.antibiogramas OWNER TO postgres;

--
-- Name: antibioticoantibiograma; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.antibioticoantibiograma (
    codantibiogr character varying(10) NOT NULL,
    codantibiot character varying(10) NOT NULL,
    posicion numeric(2,0)
);


ALTER TABLE public.antibioticoantibiograma OWNER TO postgres;

--
-- Name: antibioticos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.antibioticos (
    codantibiot character varying(10) NOT NULL,
    nomantibiot character varying(100),
    abreviatura character varying(50),
    diamresmen character varying(20),
    diammedmin character varying(20),
    diammedmax character varying(20),
    diamsensmen character varying(20),
    codexterno character varying(50)
);


ALTER TABLE public.antibioticos OWNER TO postgres;

--
-- Name: anuncios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.anuncios (
    norden numeric(10,0) NOT NULL,
    texto character varying(250) NOT NULL,
    vecliente numeric(1,0),
    veempresa numeric(1,0),
    fecha date,
    archivo character varying(100) NOT NULL
);


ALTER TABLE public.anuncios OWNER TO postgres;

--
-- Name: apertura_cierre_caja; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.apertura_cierre_caja (
    id integer NOT NULL,
    fechaapertura date,
    horaapertura character varying(8),
    codusu character varying(20),
    codservicio character varying(10),
    codcaja character varying(10),
    horacierre character varying(8),
    tipo numeric(1,0),
    codusuc character varying(20),
    monto numeric(20,2)
);


ALTER TABLE public.apertura_cierre_caja OWNER TO postgres;

--
-- Name: aranceles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aranceles (
    codarancel character varying(10) NOT NULL,
    monto numeric(10,0),
    tipo numeric(1,0),
    nomarancel character varying(250)
);


ALTER TABLE public.aranceles OWNER TO postgres;

--
-- Name: areasest; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.areasest (
    codservicio character varying(10) NOT NULL,
    codarea character varying(10) NOT NULL,
    nomarea character varying(150),
    codsector character varying(10)
);


ALTER TABLE public.areasest OWNER TO postgres;

--
-- Name: arqueo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.arqueo (
    fecha date NOT NULL,
    hora character varying(8) NOT NULL,
    codusu character varying(20),
    codcaja character varying(10),
    monto numeric(10,0),
    b1 numeric(10,0),
    b5 numeric(10,0),
    b10 numeric(10,0),
    b50 numeric(10,0),
    b100 numeric(10,0),
    b500 numeric(10,0),
    b1000 numeric(10,0),
    b2000 numeric(10,0),
    b5000 numeric(10,0),
    b10000 numeric(10,0),
    b20000 numeric(10,0),
    b50000 numeric(10,0),
    b100000 numeric(10,0),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3),
    cheques character varying(100),
    totcheques numeric(10,0),
    obs character varying(250),
    codservicio character varying(10),
    idapertura integer
);


ALTER TABLE public.arqueo OWNER TO postgres;

--
-- Name: bancos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bancos (
    codbco character varying(10) NOT NULL,
    nombco character varying(100)
);


ALTER TABLE public.bancos OWNER TO postgres;

--
-- Name: bitacora; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bitacora (
    codusu character varying(20) NOT NULL,
    codopc character varying(10) NOT NULL,
    fecha date NOT NULL,
    hora character varying(8) NOT NULL,
    accion character varying(250),
    nroip character varying(30)
);


ALTER TABLE public.bitacora OWNER TO postgres;

--
-- Name: bolutismo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bolutismo (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    nomyape character varying(150),
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    cedula character varying(15),
    dccionr character varying(200),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    tipoloc numeric(1,0),
    pais character varying(100),
    telefonor character varying(30),
    celularr character varying(30),
    dccion character varying(200),
    alimsospecho character varying(200),
    alimindus numeric(1,0),
    alimcasero numeric(1,0),
    fecconsumo date,
    lactante numeric(1,0),
    miel numeric(1,0),
    jarabema numeric(1,0),
    infusiones numeric(1,0),
    jugo numeric(1,0),
    cereales numeric(1,0),
    polvoamb numeric(1,0),
    fecocurre date,
    tipoherida numeric(1,0),
    fecinisint date,
    fec1racons date,
    establecons character varying(150),
    hospitaliza numeric(1,0),
    fechahosp date,
    diagingre character varying(200),
    sintpsont numeric(1,0),
    sintpvert numeric(1,0),
    sintpnaus numeric(1,0),
    sintpfieb numeric(1,0),
    usoarm numeric(1,0),
    eantitoxina numeric(1,0),
    demoraadm numeric(1,0),
    feclabsuer date,
    labsuero character varying(200),
    feclabmfec date,
    labmfecal character varying(200),
    feclabasp date,
    labaspirado character varying(200),
    feclabali date,
    labalimsosp character varying(200),
    feclabmher date,
    labmherida character varying(200),
    fecegreso date,
    tipoegreso numeric(1,0),
    establecim character varying(150),
    fechanotif date,
    nomyapenot character varying(150),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3)
);


ALTER TABLE public.bolutismo OWNER TO postgres;

--
-- Name: cajas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cajas (
    codservicio character varying(10) NOT NULL,
    codcaja character varying(10) NOT NULL,
    nomcaja character varying(100),
    codusu character varying(20)
);


ALTER TABLE public.cajas OWNER TO postgres;

--
-- Name: carbunco_antrax; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.carbunco_antrax (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    nomyape character varying(150),
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    cedula character varying(15),
    dccion character varying(200),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    tipoloc numeric(1,0),
    pais character varying(100),
    telefonor character varying(30),
    ocupacion character varying(150),
    dcciontraesc character varying(200),
    sitiosmort numeric(1,0),
    cuandsitios character varying(200),
    ubicsitio character varying(200),
    especie1 character varying(200),
    cantidad1 numeric(10,0),
    especie2 character varying(200),
    cantidad2 numeric(10,0),
    especie3 character varying(200),
    cantidad3 numeric(10,0),
    carne numeric(1,0),
    visceras numeric(1,0),
    huesos numeric(1,0),
    cuero numeric(1,0),
    lana numeric(1,0),
    animmuerto numeric(1,0),
    cuandcont character varying(200),
    conscarne numeric(1,0),
    cuandconsu character varying(200),
    objsospecho numeric(1,0),
    contobjeto character varying(200),
    descobjeto character varying(200),
    feciniles date,
    fec1racons date,
    ubilesion character varying(200),
    hospitaliza numeric(1,0),
    fechahosp date,
    diagingre character varying(200),
    tratamiento numeric(1,0),
    tratdrogas character varying(200),
    fectoma date,
    tipomuestra numeric(1,0),
    pruebafrotis numeric(1,0),
    pruebacultivo numeric(1,0),
    pruebaelisa numeric(1,0),
    pruebawb numeric(1,0),
    pruebapcr numeric(1,0),
    fecegreso date,
    tipoegreso numeric(1,0),
    establecim character varying(150),
    fechanotif date,
    nomyapenot character varying(150),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3)
);


ALTER TABLE public.carbunco_antrax OWNER TO postgres;

--
-- Name: chagas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.chagas (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    fechanotif date,
    nomyapenotif character varying(150),
    notificante character varying(150),
    codserv character varying(3),
    codreg character varying(2),
    coddist character varying(3),
    tdocumento numeric(1,0),
    cedula character varying(15),
    nomyape character varying(150),
    edada numeric(3,0),
    edadm numeric(2,0),
    edadd numeric(2,0),
    sexo numeric(1,0),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    dccion character varying(200),
    tipoarea numeric(1,0),
    telefono character varying(30),
    esetnia numeric(1,0),
    codetnia character varying(5),
    fechaini date,
    consultafec date,
    pamin character varying(100),
    pammax character varying(100),
    pulso character varying(100),
    frecresp character varying(100),
    peso character varying(100),
    otrossint character varying(100),
    estudiofec date,
    hb character varying(100),
    hto character varying(100),
    leucocitos character varying(100),
    vsegmentados character varying(100),
    linfocitos character varying(100),
    eosinofilos character varying(100),
    monocitos character varying(100),
    plaquetas character varying(100),
    tgo character varying(100),
    tgp character varying(100),
    bilitot character varying(100),
    bilidir character varying(100),
    biliind character varying(100),
    creatinina character varying(100),
    urea character varying(100),
    glicemia character varying(100),
    ecg character varying(100),
    rayosx character varying(100),
    otrosrep character varying(100),
    dxingreso character varying(100),
    tratamiento character varying(100),
    fechartat date,
    dosis character varying(50),
    condalta character varying(100),
    fechaalta date,
    estado numeric(1,0)
);


ALTER TABLE public.chagas OWNER TO postgres;

--
-- Name: colera; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.colera (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    nomyape character varying(150),
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    cedula character varying(15),
    dccion character varying(200),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    tipoloc numeric(1,0),
    pais character varying(100),
    telefonor character varying(30),
    ocupacion character varying(150),
    dcciontraesc character varying(200),
    aguadentro numeric(1,0),
    aguaterreno numeric(1,0),
    aguafuera numeric(1,0),
    aguared numeric(1,0),
    aguapozo numeric(1,0),
    aguabomba numeric(1,0),
    agualluvia numeric(1,0),
    banio numeric(1,0),
    letrina numeric(1,0),
    contpers numeric(1,0),
    lugarcont numeric(1,0),
    trabsalud numeric(1,0),
    establecimt character varying(150),
    fecinisint date,
    fec1racons date,
    establecons character varying(150),
    deshidra numeric(1,0),
    forma numeric(1,0),
    cantevac numeric(2,0),
    consistencia numeric(1,0),
    fechosp date,
    rehidra numeric(1,0),
    formamtra numeric(1,0),
    tratantibio numeric(1,0),
    tipoantibio numeric(1,0),
    matfecal numeric(1,0),
    fecmuestra date,
    resmfecal character varying(200),
    tipoprueba numeric(1,0),
    vivrium numeric(1,0),
    fecegreso date,
    tipoegreso numeric(1,0),
    establecim character varying(150),
    fechanotif date,
    nomyapenot character varying(150),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3)
);


ALTER TABLE public.colera OWNER TO postgres;

--
-- Name: config_gral; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.config_gral (
    codservicio character varying(10) NOT NULL,
    director character varying(150),
    cargodir character varying(100),
    nomyapefir character varying(150),
    cuentagral character varying(100),
    nomctagral character varying(200),
    nomyapedep character varying(150),
    concepto character varying(200),
    n_recibo_ini numeric(10,0),
    n_recibo numeric(10,0),
    n_recibo_fin numeric(10,0),
    serie character varying(10),
    np_mensaje numeric(10,0),
    decreto character varying(100),
    ruc character varying(50)
);


ALTER TABLE public.config_gral OWNER TO postgres;

--
-- Name: contrasenias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contrasenias (
    codusu character varying(20) NOT NULL,
    fecha date NOT NULL,
    hora character varying(8) NOT NULL,
    claveant character varying(20),
    clavenueva character varying(20)
);


ALTER TABLE public.contrasenias OWNER TO postgres;

--
-- Name: courier; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.courier (
    codcourier character varying(10) NOT NULL,
    nomcourier character varying(200),
    director character varying(200),
    dccion character varying(250),
    telefono character varying(100),
    email character varying(200),
    estado numeric(1,0)
);


ALTER TABLE public.courier OWNER TO postgres;

--
-- Name: creut_jakob; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.creut_jakob (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    nomyape character varying(150),
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    cedula character varying(15),
    dccion character varying(200),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    tipoloc numeric(1,0),
    pais character varying(100),
    celularr character varying(30),
    ocupacion character varying(150),
    dcciontra character varying(200),
    reinounido numeric(1,0),
    fecdesde date,
    fechasta date,
    transplante numeric(1,0),
    fectransp date,
    tipotransp character varying(200),
    injertos numeric(1,0),
    fecinjerto date,
    motinjerto character varying(200),
    transfusion numeric(1,0),
    fectransfu date,
    mottrasfu character varying(200),
    hormhipo numeric(1,0),
    fecinitrat date,
    duracion character varying(200),
    antneruo character varying(200),
    fecpracneu date,
    establecprac character varying(150),
    antecfam numeric(1,0),
    parentesco character varying(50),
    anioini numeric(4,0),
    parientemto numeric(1,0),
    contactgana numeric(1,0),
    cuandocons character varying(200),
    lprocedencia character varying(200),
    nrohclinica character varying(20),
    fecinisint date,
    fec1racons date,
    diagcons character varying(200),
    fechosp date,
    diaghosp character varying(200),
    fec1rarad date,
    electroence numeric(1,0),
    radioelectro character varying(200),
    resonmagn numeric(1,0),
    radioreson character varying(200),
    fecultradio date,
    electroence2 numeric(1,0),
    fecultelec date,
    resonmagn2 numeric(1,0),
    fecradio date,
    labolcr numeric(1,0),
    feclcrprot date,
    lablcrotr character varying(200),
    fallecido numeric(1,0),
    fecdefun date,
    descartado numeric(1,0),
    confirmado numeric(1,0),
    confirmapor numeric(1,0),
    paiscontag numeric(1,0),
    paiscontagdes character varying(200),
    clasfinal numeric(1,0),
    fechanotif date,
    nomyapenot character varying(150),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3)
);


ALTER TABLE public.creut_jakob OWNER TO postgres;

--
-- Name: datoagrupado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.datoagrupado (
    grupo character varying(10) NOT NULL,
    nromuestra character varying(20) NOT NULL,
    nropaciente numeric(10,0),
    codservicioe character varying(10) NOT NULL,
    codservicior character varying(10),
    fecha date,
    nordentra integer NOT NULL,
    codusu character varying(20),
    estado numeric(1,0),
    fecharec date,
    codcourier character varying(10),
    almacena character varying(200),
    obs character varying(250),
    codservicio character varying(10) NOT NULL
);


ALTER TABLE public.datoagrupado OWNER TO postgres;

--
-- Name: departamentos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.departamentos (
    coddpto character varying(10) NOT NULL,
    nomdpto character varying(255) DEFAULT NULL::character varying,
    highmaps character varying(10) DEFAULT NULL::character varying,
    coordenadas character varying(100) DEFAULT NULL::character varying
);


ALTER TABLE public.departamentos OWNER TO postgres;

--
-- Name: determinacionequipo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.determinacionequipo (
    codestudio character varying(10) NOT NULL,
    coddetermina character varying(10) NOT NULL,
    codequipo character varying(10) NOT NULL,
    codmetodo character varying(10) NOT NULL,
    posicion numeric(3,0)
);


ALTER TABLE public.determinacionequipo OWNER TO postgres;

--
-- Name: determinaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.determinaciones (
    codestudio character varying(10),
    coddetermina character varying(10) NOT NULL,
    nomdetermina character varying(100),
    codumedida character varying(10),
    codresultado character varying(10),
    posicion numeric(5,0),
    tipo character varying(1),
    abreviatura character varying(20),
    tiempohab numeric(3,0),
    tiempourg numeric(3,0),
    aliasdetermina character varying(100),
    aliasabreviatura character varying
);


ALTER TABLE public.determinaciones OWNER TO postgres;

--
-- Name: determinaciones_equipos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.determinaciones_equipos (
    codestudio character varying(10) NOT NULL,
    coddetermina character varying(10) NOT NULL,
    codequipo character varying(10) NOT NULL,
    coddetermina_equipo character varying(10) NOT NULL
);


ALTER TABLE public.determinaciones_equipos OWNER TO postgres;

--
-- Name: determinacionesmaster; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.determinacionesmaster (
    coddetermina character varying(10) NOT NULL,
    nomdetermina character varying(100),
    codumedida character varying(10),
    codresultado character varying(10),
    posicion numeric(5,0),
    tipo character varying(1),
    abreviatura character varying(20),
    tiempohab numeric(3,0),
    tiempourg numeric(3,0)
);


ALTER TABLE public.determinacionesmaster OWNER TO postgres;

--
-- Name: determinacionrango; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.determinacionrango (
    codestudio character varying(10) NOT NULL,
    coddetermina character varying(10) NOT NULL,
    tipo numeric(1,0) NOT NULL,
    sexo numeric(1,0),
    edadmin numeric(3,0),
    edadmax numeric(3,0),
    inirango numeric(10,0),
    finrango numeric(10,0),
    codresultado1 character varying(10),
    codresultado2 character varying(10),
    codresultado3 character varying(10),
    tipoedad numeric(1,0),
    generico character varying(200)
);


ALTER TABLE public.determinacionrango OWNER TO postgres;

--
-- Name: determinacionrangomaster; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.determinacionrangomaster (
    coddetermina character varying(10) NOT NULL,
    tipo numeric(1,0) NOT NULL,
    sexo numeric(1,0),
    edadmin numeric(3,0),
    edadmax numeric(3,0),
    inirango numeric(10,0),
    finrango numeric(10,0),
    codresultado1 character varying(10),
    codresultado2 character varying(10),
    codresultado3 character varying(10),
    tipoedad numeric(1,0)
);


ALTER TABLE public.determinacionrangomaster OWNER TO postgres;

--
-- Name: diagnostico; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.diagnostico (
    coddiagnostico character varying(10) NOT NULL,
    nomdiagnostico character varying(200)
);


ALTER TABLE public.diagnostico OWNER TO postgres;

--
-- Name: difteria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.difteria (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    fechacons date,
    fechacap date,
    fechanotif date,
    nomyapenot character varying(150),
    telefononot character varying(30),
    celularnot character varying(30),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3),
    subsector numeric(1,0),
    subsectoresp character varying(150),
    conocio numeric(1,0),
    conociootr character varying(150),
    cedula character varying(15),
    nomyape character varying(150),
    fechanac date,
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    nacionalidad character varying(100),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    dccion character varying(200),
    referencia character varying(200),
    telefonor character varying(30),
    celularr character varying(30),
    tipoloc numeric(1,0),
    esetnia numeric(1,0),
    codetnia character varying(5),
    ocupacion character varying(150),
    dcciontraesc character varying(200),
    nommadre character varying(150),
    cedulamadre character varying(15),
    vacunafte numeric(1,0),
    tipovacuna numeric(1,0),
    ndosis character varying(30),
    fec1rados date,
    fec2dados date,
    fec3rados date,
    fec1erref date,
    fec2doref date,
    codregvac character varying(2),
    subcregvac character varying(3),
    coddistvac character varying(3),
    codservvac character varying(3),
    fecinisint date,
    hospitaliza numeric(1,0),
    establecimh character varying(150),
    fecadmin date,
    diasonter numeric(3,0),
    nrohclinica character varying(20),
    alta numeric(1,0),
    secuelas character varying(200),
    fecalta date,
    tratamiento numeric(1,0),
    antitoxcual character varying(200),
    antitoxdos character varying(30),
    fectratdift date,
    antibiocual character varying(200),
    antibiotdos character varying(30),
    fectratantib date,
    otrmed character varying(200),
    otrmeddos character varying(30),
    fectratotr date,
    defuncion numeric(1,0),
    lugdefun character varying(200),
    fecdefun date,
    causadef character varying(200),
    fecvisita date,
    contactocaso numeric(1,0),
    feccontact date,
    sospechadift numeric(1,0),
    feccaso date,
    viajo720 numeric(1,0),
    dondeviajo character varying(200),
    fecviaje date,
    seguimient7 numeric(1,0),
    fecdesde date,
    fechasta date,
    antibioprev numeric(1,0),
    antobutil character varying(200),
    clasfinal numeric(1,0),
    fecfinal date
);


ALTER TABLE public.difteria OWNER TO postgres;

--
-- Name: distritos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.distritos (
    coddpto character varying(10) NOT NULL,
    coddist character varying(10) NOT NULL,
    nomdist character varying(255) DEFAULT NULL::character varying,
    codreg character varying(10) DEFAULT NULL::character varying,
    subcreg character varying(10) DEFAULT NULL::character varying
);


ALTER TABLE public.distritos OWNER TO postgres;

--
-- Name: emicrobiologia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.emicrobiologia (
    codestudiobio character varying(10) NOT NULL,
    nomestudiobio character varying(150),
    obsestudio character varying(250),
    obsrecep character varying(250),
    obsmedico character varying(250)
);


ALTER TABLE public.emicrobiologia OWNER TO postgres;

--
-- Name: empresas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.empresas (
    codempresa integer NOT NULL,
    laboratorio numeric(1,0),
    razonsocial character varying(200),
    ruc character varying(50),
    responsable character varying(150),
    cargoresp character varying(100),
    dccion character varying(200),
    coddpto character varying(2),
    coddist character varying(3),
    barrio character varying(150),
    zona numeric(1,0),
    telefono character varying(30),
    celular character varying(30),
    email character varying(100),
    obs character varying(250),
    estado numeric(1,0)
);


ALTER TABLE public.empresas OWNER TO postgres;

--
-- Name: enfermedades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.enfermedades (
    nomenferm character varying(50) NOT NULL,
    codenferm character varying(10) NOT NULL
);


ALTER TABLE public.enfermedades OWNER TO postgres;

--
-- Name: enfsintomas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.enfsintomas (
    codenferm character varying(50) NOT NULL,
    norden numeric(2,0) NOT NULL,
    codsintoma character varying(10) NOT NULL,
    tipo numeric(1,0) NOT NULL
);


ALTER TABLE public.enfsintomas OWNER TO postgres;

--
-- Name: equipos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.equipos (
    codequipo character varying(10) NOT NULL,
    tipo character varying(100),
    descripcion character varying(200),
    tipodato character varying(15),
    programa character varying(200),
    crc numeric(1,0),
    confirmares numeric(1,0),
    comport numeric(1,0),
    hasdshking numeric(1,0),
    baudrate numeric(2,0),
    stopbit numeric(1,0),
    parity numeric(1,0),
    bits numeric(1,0),
    confres numeric(1,0),
    recsenial numeric(1,0),
    visualres numeric(1,0),
    envioautom numeric(1,0),
    posidcol numeric(2,0),
    separadec numeric(1,0),
    escrres numeric(1,0),
    rutalog character varying(200)
);


ALTER TABLE public.equipos OWNER TO postgres;

--
-- Name: establecimientos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.establecimientos (
    codservicio character varying(10) NOT NULL,
    nomservicio character varying(150),
    tiposerv character varying(5),
    nomserv character varying(150),
    director character varying(150),
    dccion character varying(200),
    telefono character varying(30),
    email character varying(50),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3)
);


ALTER TABLE public.establecimientos OWNER TO postgres;

--
-- Name: estadoresultado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estadoresultado (
    codestado character varying(5) NOT NULL,
    nomestado character varying(100)
);


ALTER TABLE public.estadoresultado OWNER TO postgres;

--
-- Name: estrealizar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estrealizar (
    nroestudio integer NOT NULL,
    codservicio character varying(10),
    codarea character varying(10),
    codusu character varying(20),
    nropaciente numeric(10,0),
    fecha date,
    hora character varying(8),
    codestudio character varying(10),
    codservicior character varying(10),
    codserviciod character varying(10),
    coddiagnostico character varying(10),
    estadoestu numeric(1,0),
    fechatmues date,
    horatmues character varying(8),
    codtmuestra character varying(10),
    nromuestra integer,
    nroturno character varying(10),
    nordentra integer,
    codservact character varying(10),
    validar numeric(1,0),
    codorigen character varying(10),
    codmedico character varying(10),
    cod_dgvs bigint,
    nro_toma character varying(50),
    orden_dgvs character varying(20),
    nroficha integer,
    idlab integer,
    id_secciones_ficha integer,
    cod_dgvs2 integer,
    hospitalizado character varying(2),
    fallecido character varying(2),
    traspasarhl boolean
);


ALTER TABLE public.estrealizar OWNER TO postgres;

--
-- Name: estudios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estudios (
    codestudio character varying(10) NOT NULL,
    codexterno character varying(10),
    nomestudio character varying(100),
    abreviatura character varying(20),
    dias numeric(2,0),
    codsector character varying(10),
    codtmuestra character varying(10),
    cantetiq numeric(2,0),
    factor numeric(10,3),
    microbiologia numeric(1,0),
    codestudiobio character varying(10),
    estado numeric(1,0),
    enviarec numeric(1,0),
    obs character varying(250),
    codmetodo character varying(10),
    posicion numeric(5,0),
    index boolean
);


ALTER TABLE public.estudios OWNER TO postgres;

--
-- Name: eta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.eta (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    nomyape character varying(150),
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    cedula character varying(15),
    dccion character varying(200),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    tipoloc numeric(1,0),
    pais character varying(100),
    celularr character varying(30),
    ocupacion character varying(150),
    dcciontraesc character varying(200),
    relamanipula numeric(1,0),
    relacomensal numeric(1,0),
    relaotro numeric(1,0),
    relaotroesp character varying(150),
    fecinisint date,
    horaini character varying(8),
    hospitaliza numeric(1,0),
    medicado numeric(1,0),
    medicual character varying(200),
    fecinitoma date,
    tipomtheces numeric(1,0),
    tmhageti character varying(200),
    tmhgb character varying(200),
    tmhinter character varying(200),
    tipomtvomito numeric(1,0),
    tmvageti character varying(200),
    tmvinter character varying(200),
    tipomtsangre numeric(1,0),
    tmsageti character varying(200),
    tmsinter character varying(200),
    tipomtresto numeric(1,0),
    tmrageti character varying(200),
    tmrinter character varying(200),
    alimplicado character varying(200),
    fechanotif date,
    nomyapenot character varying(150),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3)
);


ALTER TABLE public.eta OWNER TO postgres;

--
-- Name: etaantecend; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.etaantecend (
    nronotif numeric(10,0) NOT NULL,
    ocasion numeric(1,0) NOT NULL,
    nordentra character varying(20),
    alimentoing character varying(200) NOT NULL,
    hora character varying(8) NOT NULL,
    lugar character varying(200)
);


ALTER TABLE public.etaantecend OWNER TO postgres;

--
-- Name: etiirag; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.etiirag (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    fechanotif date,
    nomyapenot character varying(150),
    cargonotif numeric(1,0),
    codserv character varying(3),
    codreg character varying(2),
    coddist character varying(3),
    nomyape character varying(150),
    sexo numeric(1,0),
    edad numeric(3,0),
    fechanac date,
    dccion character varying(200),
    barrio character varying(100),
    coddistr character varying(3),
    coddptor character varying(2),
    telefonor character varying(30),
    fechainis date,
    fechacons date,
    formapac numeric(1,0),
    temperatura character varying(50),
    otrossint character varying(100),
    impdiagnost character varying(100),
    complicaclin numeric(1,0),
    viajezonaaf numeric(1,0),
    viajepais character varying(100),
    fechavia date,
    fecharet date,
    viajeair numeric(1,0),
    viajelinea character varying(100),
    fechavue date,
    horallega character varying(8),
    viaterr numeric(1,0),
    cniabuses character varying(100),
    vprivado numeric(1,0),
    viafluvial numeric(1,0),
    contacgripe numeric(1,0),
    contacesp character varying(100),
    nomyapecont character varying(150),
    dccioncont character varying(200),
    telefonocont character varying(30),
    relcaso numeric(1,0),
    relotro character varying(100),
    vacinfluenza numeric(1,0),
    fecvacinflu date,
    fechatm date,
    fechaenvio date,
    laboratorio character varying(100),
    tipomuestra numeric(1,0)
);


ALTER TABLE public.etiirag OWNER TO postgres;

--
-- Name: evalanalitos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evalanalitos (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    marcaeq character varying(100),
    recativo character varying(100),
    metodo character varying(100),
    resulpatolog character varying(100),
    resulcnorm character varying(100),
    resullote character varying(100),
    umedida character varying(30),
    puntaje numeric(10,2),
    resulprevisto character varying(100),
    analito numeric(2,0) NOT NULL
);


ALTER TABLE public.evalanalitos OWNER TO postgres;

--
-- Name: evalbioquimica; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evalbioquimica (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    permes numeric(2,0),
    peranio numeric(4,0),
    fecha date,
    lote character varying(20),
    tiposerv numeric(1,0),
    codservicio character varying(10),
    responsable character varying(150),
    cargo character varying(100),
    puntaje numeric(10,2)
);


ALTER TABLE public.evalbioquimica OWNER TO postgres;

--
-- Name: evaldengue; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evaldengue (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    permes numeric(2,0),
    peranio numeric(4,0),
    fecha date,
    lote character varying(20),
    tiposerv numeric(1,0),
    codservicio character varying(10),
    responsable character varying(150),
    cargo character varying(150),
    metodo character varying(100),
    reactivo character varying(100),
    equipo character varying(100),
    marcaeq character varying(100),
    puntaje numeric(10,2)
);


ALTER TABLE public.evaldengue OWNER TO postgres;

--
-- Name: evaleducacioncontinua; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evaleducacioncontinua (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    permes numeric(2,0),
    peranio numeric(4,0),
    fecha date,
    lote character varying(20),
    tiposerv numeric(1,0),
    codservicio character varying(10),
    responsable character varying(150),
    cargo character varying(150),
    puntaje numeric(10,2)
);


ALTER TABLE public.evaleducacioncontinua OWNER TO postgres;

--
-- Name: evalhematologia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evalhematologia (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    permes numeric(2,0),
    peranio numeric(4,0),
    fecha date,
    lote character varying(20),
    tiposerv numeric(1,0),
    codservicio character varying(10),
    responsable character varying(150),
    cargo character varying(150),
    flneutroband character varying(100),
    flneutrosegm character varying(100),
    fllinfo character varying(100),
    fllinforeact character varying(100),
    flmonocito character varying(100),
    fleosinofilo character varying(100),
    flbasofilo character varying(100),
    flblastos character varying(100),
    flmielocitos character varying(100),
    flmetamielo character varying(100),
    sbsinalt numeric(1,0) DEFAULT 2,
    sbgranu numeric(1,0) DEFAULT 2,
    sbnucleo numeric(1,0) DEFAULT 2,
    sbvacuola numeric(1,0) DEFAULT 2,
    srsinalt numeric(1,0) DEFAULT 2,
    sranisocit numeric(1,0) DEFAULT 2,
    srmicrocito numeric(1,0) DEFAULT 2,
    srmacrocito numeric(1,0) DEFAULT 2,
    srnormocit numeric(1,0) DEFAULT 2,
    srpoiquilocit numeric(1,0) DEFAULT 2,
    srnormocrom numeric(1,0) DEFAULT 2,
    srhipocromia numeric(1,0) DEFAULT 2,
    srpolicroma numeric(1,0) DEFAULT 2,
    srnormobla numeric(1,0) DEFAULT 2,
    spmacroplaqsa numeric(1,0) DEFAULT 2,
    spmacropaq numeric(1,0) DEFAULT 2,
    parleishmania numeric(1,0) DEFAULT 2,
    parplasmod numeric(1,0) DEFAULT 2,
    flneutrobandr character varying(100),
    flneutrosegmr character varying(100),
    fllinfor character varying(100),
    fllinforeactr character varying(100),
    flmonocitor character varying(100),
    fleosinofilor character varying(100),
    flbasofilor character varying(100),
    flblastosr character varying(100),
    flmielocitosr character varying(100),
    flmetamielor character varying(100),
    sbsinaltr numeric(1,0) DEFAULT 2,
    sbgranur numeric(1,0) DEFAULT 2,
    sbnucleor numeric(1,0) DEFAULT 2,
    sbvacuolar numeric(1,0) DEFAULT 2,
    srsinaltr numeric(1,0) DEFAULT 2,
    sranisocitr numeric(1,0) DEFAULT 2,
    srmicrocitor numeric(1,0) DEFAULT 2,
    srmacrocitor numeric(1,0) DEFAULT 2,
    srnormocitr numeric(1,0) DEFAULT 2,
    srpoiquilocitr numeric(1,0) DEFAULT 2,
    srnormocromr numeric(1,0) DEFAULT 2,
    srhipocromiar numeric(1,0) DEFAULT 2,
    srpolicromar numeric(1,0) DEFAULT 2,
    srnormoblar numeric(1,0) DEFAULT 2,
    spmacroplaqsar numeric(1,0) DEFAULT 2,
    spmacropaqr numeric(1,0) DEFAULT 2,
    parleishmaniar numeric(1,0) DEFAULT 2,
    parplasmodr numeric(1,0) DEFAULT 2,
    puntaje numeric(10,2)
);


ALTER TABLE public.evalhematologia OWNER TO postgres;

--
-- Name: evalinfluenza; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evalinfluenza (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    permes numeric(2,0),
    peranio numeric(4,0),
    fecha date,
    lote character varying(20),
    tiposerv numeric(1,0),
    codservicio character varying(10),
    responsable character varying(150),
    cargo character varying(150),
    metodo character varying(150),
    reactivo character varying(150),
    equipos character varying(150),
    marcaeq character varying(150),
    puntaje numeric(10,2)
);


ALTER TABLE public.evalinfluenza OWNER TO postgres;

--
-- Name: evalmalaria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evalmalaria (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    permes numeric(2,0),
    peranio numeric(4,0),
    fecharec date,
    lote character varying(20),
    tiposerv numeric(1,0),
    codservicio character varying(10),
    responsable character varying(150),
    cargo character varying(150),
    tipocontrol character varying(50),
    fechares date,
    obs character varying(250),
    puntaje numeric(10,2)
);


ALTER TABLE public.evalmalaria OWNER TO postgres;

--
-- Name: evalpintestinal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evalpintestinal (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    permes numeric(2,0),
    peranio numeric(4,0),
    fecha date,
    lote character varying(20),
    tiposerv numeric(1,0),
    codservicio character varying(10),
    responsable character varying(150),
    cargo character varying(150),
    quisteenco numeric(1,0),
    ooquiste numeric(1,0),
    formasvacu numeric(1,0),
    quistecoli numeric(1,0),
    huevoasca numeric(1,0),
    huevohyme numeric(1,0),
    quistehist numeric(1,0),
    huevounci numeric(1,0),
    huevohymena numeric(1,0),
    quistegiar numeric(1,0),
    huevotric numeric(1,0),
    huevoverm numeric(1,0),
    quisteioda numeric(1,0),
    huevotaen numeric(1,0),
    huevoschi numeric(1,0),
    quistechil numeric(1,0),
    larvastron numeric(1,0),
    larvafila numeric(1,0),
    ooisteiso numeric(1,0),
    larvaunci numeric(1,0),
    larvaancy numeric(1,0),
    noseobs numeric(1,0),
    otrosesp character varying(250),
    quisteencor numeric(1,0),
    ooquister numeric(1,0),
    formasvacur numeric(1,0),
    quistecolir numeric(1,0),
    huevoascar numeric(1,0),
    huevohymer numeric(1,0),
    quistehistr numeric(1,0),
    huevouncir numeric(1,0),
    huevohymenar numeric(1,0),
    quistegiarr numeric(1,0),
    huevotricr numeric(1,0),
    huevovermr numeric(1,0),
    quisteiodar numeric(1,0),
    huevotaenr numeric(1,0),
    huevoschir numeric(1,0),
    quistechilr numeric(1,0),
    larvastronr numeric(1,0),
    larvafilar numeric(1,0),
    ooisteisor numeric(1,0),
    larvauncir numeric(1,0),
    larvaancyr numeric(1,0),
    noseobsr numeric(1,0),
    otrosespr character varying(250),
    puntaje numeric(10,2)
);


ALTER TABLE public.evalpintestinal OWNER TO postgres;

--
-- Name: evalrotavirus; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evalrotavirus (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    permes numeric(2,0),
    peranio numeric(4,0),
    fecha date,
    lote character varying(20),
    tiposerv numeric(1,0),
    codservicio character varying(10),
    responsable character varying(150),
    cargo character varying(150),
    fecharec date,
    condrefrig numeric(1,0),
    condderrame numeric(1,0),
    obs character varying(250),
    puntaje numeric(10,2)
);


ALTER TABLE public.evalrotavirus OWNER TO postgres;

--
-- Name: evalsifilis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evalsifilis (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    permes numeric(2,0),
    peranio numeric(4,0),
    fecha date,
    lote character varying(20),
    fechares date,
    tiposerv numeric(1,0),
    codservicio character varying(10),
    nrovales numeric(3,0),
    refrigerados numeric(1,0),
    vcerrados numeric(1,0),
    derrames numeric(1,0),
    responsable character varying(150),
    cargo character varying(100),
    puntaje numeric(10,2)
);


ALTER TABLE public.evalsifilis OWNER TO postgres;

--
-- Name: seq_evaluacion; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_evaluacion
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_evaluacion OWNER TO postgres;

--
-- Name: evaluacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evaluacion (
    nroeval numeric(10,0) DEFAULT nextval('public.seq_evaluacion'::regclass) NOT NULL,
    permes numeric(2,0),
    peranio numeric(4,0),
    fecharegistro date,
    lote character varying(20),
    codservicio character varying(10),
    puntaje numeric(5,2),
    escala numeric(3,0),
    fecharcierre date,
    codsector character varying(10),
    fechainicio date,
    tipo character varying(1),
    obs character varying(200),
    subprograma character varying(50),
    metodo character varying(100),
    reactivo character varying(100),
    marca character varying(100),
    loteev character varying(100),
    fechaven date,
    equipo character varying(100),
    obsev character varying(200),
    rmuestra numeric(1,0) DEFAULT 1,
    cantfila character varying(2),
    enunciado character varying(500)
);


ALTER TABLE public.evaluacion OWNER TO postgres;

--
-- Name: evaluaciondet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evaluaciondet (
    nroeval numeric(10,0) NOT NULL,
    item numeric(3,0) NOT NULL,
    fecharegistro date,
    pregunta character varying(500),
    opc1 character varying(350),
    opc2 character varying(350),
    opc3 character varying(350),
    opc4 character varying(350),
    opc5 character varying(350),
    respuesta character varying(1),
    puntaje numeric(5,2),
    terminado numeric(1,0) DEFAULT 1,
    opc6 character varying(200),
    opc7 character varying(200)
);


ALTER TABLE public.evaluaciondet OWNER TO postgres;

--
-- Name: evaluaciondeterminacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evaluaciondeterminacion (
    nroeval numeric(10,0) NOT NULL,
    codestudio character varying(10) NOT NULL,
    coddetermina character varying(10) NOT NULL,
    respuesta character varying(100),
    puntaje numeric(10,0),
    terminado numeric(1,0) DEFAULT 1,
    correcta character varying(100),
    drp numeric(10,0)
);


ALTER TABLE public.evaluaciondeterminacion OWNER TO postgres;

--
-- Name: evaluaciondetestu; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evaluaciondetestu (
    nroeval numeric(10,0) NOT NULL,
    codestudio character varying(10) NOT NULL,
    fecharegistro date
);


ALTER TABLE public.evaluaciondetestu OWNER TO postgres;

--
-- Name: evalucionparticipante; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.evalucionparticipante (
    nroeval numeric(10,0) NOT NULL,
    item numeric(3,0) NOT NULL,
    codusu character varying(20),
    estado character varying(1) DEFAULT 1
);


ALTER TABLE public.evalucionparticipante OWNER TO postgres;

--
-- Name: febrilagudo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.febrilagudo (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    fechanotif date,
    nomyapenot character varying(150),
    cargonotif character varying(100),
    codserv character varying(3),
    codreg character varying(2),
    coddist character varying(3),
    nrohc numeric(10,0),
    paludismo numeric(1,0),
    dengue numeric(1,0),
    fiebreama numeric(1,0),
    leptospirosis numeric(1,0),
    hantavirus numeric(1,0),
    chikingunya numeric(1,0),
    zika numeric(1,0),
    scotros numeric(1,0),
    scotrosesp character varying(100),
    nomyape character varying(150),
    tdocumento numeric(1,0),
    cedula character varying(15),
    fechanac date,
    edad numeric(3,0),
    sexo numeric(1,0),
    coddptor character varying(2),
    coddistr character varying(3),
    tipoarea numeric(1,0),
    codbarrior character varying(3),
    otrobarrior character varying(100),
    referencia character varying(250),
    dccionr character varying(200),
    telefonor character varying(30),
    esetnia numeric(1,0),
    codetnia character varying(5),
    dchospitaliza numeric(1,0),
    dcambulatorio numeric(1,0),
    dcfechahosp date,
    dcfechacons date,
    dcfirbre numeric(1,0),
    dctemper character varying(10),
    dcfecini date,
    dcfecfin date,
    dcuci numeric(1,0),
    dcfecingre date,
    dcotros character varying(200),
    dcpamin numeric(5,0),
    dcpamax numeric(5,0),
    dcpulso numeric(10,2),
    dcfr numeric(5,0),
    dcplazo numeric(1,0),
    dcpdmax numeric(10,2),
    dcpdmin numeric(10,2),
    deocup character varying(200),
    coddptotra character varying(3),
    coddistt character varying(3),
    detipoarea numeric(1,0),
    deviajoud numeric(1,0),
    deviajofec date,
    coddptoud character varying(2),
    coddistud character varying(3),
    decampo numeric(1,0),
    decampofec date,
    codsptoca character varying(3),
    coddistca character varying(3),
    cuadrosant numeric(1,0),
    cuadroafec date,
    cuadantdiag character varying(100),
    casossimil numeric(1,0),
    casosvecin numeric(1,0),
    casostra numeric(1,0),
    vivesolo numeric(1,0),
    vivedificil numeric(1,0),
    pobrezaext numeric(1,0),
    embarazo numeric(1,0),
    diabetes numeric(1,0),
    inmunocomp numeric(1,0),
    deotrosesp character varying(200),
    vacunaaa numeric(1,0),
    vacaafec date,
    labhto numeric(10,2),
    labgb numeric(10,0),
    labformu character varying(100),
    labplaqueta numeric(10,0),
    labvsg numeric(10,0),
    labfechemo date,
    labpaludismo numeric(1,0),
    labpalufec date,
    labpalutec character varying(100),
    landengue numeric(1,0),
    landenfec date,
    labdentec character varying(100),
    labofa numeric(1,0),
    labfafec date,
    labfatec character varying(100),
    lablepto numeric(1,0),
    lableptofec date,
    lableptotec character varying(100),
    labhanta numeric(1,0),
    labhantafec date,
    labhantatec character varying(100),
    lanchi numeric(1,0),
    labchifec date,
    labchitec character varying(100),
    labzika numeric(1,0),
    labzikafec date,
    labzikatec character varying(100),
    cierrediag numeric(1,0),
    cierrediagesp character varying(200),
    cierrefec date,
    cierrecaso numeric(1,0),
    cierrefalta date
);


ALTER TABLE public.febrilagudo OWNER TO postgres;

--
-- Name: febriles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.febriles (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    sarampion numeric(1,0),
    rubeola numeric(1,0),
    sosotros numeric(1,0),
    sosotrosesp character varying(100),
    fechanotif date,
    nomyapenot character varying(150),
    cargonotif character varying(100),
    codserv character varying(3),
    codreg character varying(2),
    codsist character varying(3),
    nominvest character varying(150),
    cargoinvest character varying(100),
    fechacap date,
    conocio numeric(1,0),
    nomyape character varying(150),
    edada numeric(3,0),
    edadm numeric(2,0),
    sexo numeric(1,0),
    dccion character varying(200),
    barrio character varying(100),
    coddistr character varying(3),
    coddptor character varying(2),
    referencia character varying(250),
    telefono character varying(30),
    vacasaram numeric(1,0),
    vacasarmdosi character varying(50),
    fechaudsar date,
    vacarubeo numeric(1,0),
    vacrubeodosi character varying(50),
    fechaudrub date,
    nommadre character varying(100),
    fiebre numeric(1,0),
    fechafieb date,
    fechavisita date,
    tipoerup numeric(1,0),
    duraerup numeric(3,0),
    fechainieru date,
    tos numeric(1,0),
    coriza numeric(1,0),
    conjutivitis numeric(1,0),
    adenopatia numeric(1,0),
    artralgia numeric(1,0),
    embarazada numeric(1,0),
    nrosemana numeric(2,0),
    lugarparto character varying(100),
    hospitalizado numeric(1,0),
    defuncion numeric(1,0),
    fechatm1 date,
    fecharec1 date,
    fechares1 date,
    tipoprueba character varying(1),
    anticuerpo character varying(1),
    resultado character varying(1),
    fechatm2 date,
    laboratorio character varying(100),
    fecharec2 date,
    fechares2 date,
    tipoprueba2 character varying(1),
    anticuerpo2 character varying(1),
    resultado2 character varying(1),
    contacotr numeric(1,0),
    casosaram numeric(1,0),
    viaje723 numeric(1,0),
    viajedonde723 character varying(200),
    contacembar numeric(1,0),
    clasiffindesc numeric(1,0),
    clasiffinconf numeric(1,0),
    confirma numeric(1,0),
    importado numeric(1,0),
    fechadiaf date,
    respdiag character varying(150)
);


ALTER TABLE public.febriles OWNER TO postgres;

--
-- Name: feriados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.feriados (
    nroorden numeric(10,0) NOT NULL,
    dia numeric(2,0),
    mes numeric(2,0),
    anio numeric(4,0),
    motivo character varying(200),
    esanual numeric(1,0)
);


ALTER TABLE public.feriados OWNER TO postgres;

--
-- Name: fichas_dgvs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fichas_dgvs (
    nordentra character varying(30) NOT NULL,
    nroficha character varying(30) NOT NULL,
    hospitalizado character varying(30) NOT NULL,
    fallecido character varying(30) NOT NULL,
    card_cron character varying(30) NOT NULL,
    diabetes character varying(30) NOT NULL,
    puerpera character varying(30) NOT NULL,
    enbarazada character varying(30) NOT NULL,
    trim_emba character varying(30) NOT NULL,
    sem_gest character varying(30) NOT NULL,
    otros character varying(30) NOT NULL,
    enf_pul_cro character varying(30) NOT NULL,
    enf_neu_cro character varying(30) NOT NULL,
    enf_ren_cro character varying(30) NOT NULL,
    obesidad character varying(30) NOT NULL,
    enf_hepa_cro character varying(30) NOT NULL,
    desnutricion character varying(30) NOT NULL,
    nauseas character varying(30) NOT NULL,
    dolor_ret_orbital character varying(30) NOT NULL,
    artralgia character varying(30) NOT NULL,
    tipo_artr character varying(30) NOT NULL,
    petequias character varying(30) NOT NULL,
    vomi_persis character varying(30) NOT NULL,
    hepatomegalia character varying(30) NOT NULL,
    sang_grave character varying(30) NOT NULL,
    lactante character varying(30) NOT NULL,
    erup_rash_cut character varying(30) NOT NULL,
    prurito character varying(30) NOT NULL,
    vomitos character varying(30) NOT NULL,
    mialgia character varying(30) NOT NULL,
    leucopenia character varying(30) NOT NULL,
    acum_liquid character varying(30) NOT NULL,
    aumen_prog_hematocrito character varying(30) NOT NULL,
    dan_grav_org character varying(30) NOT NULL,
    erup_cutanea character varying(30) NOT NULL,
    fecha character varying(30) NOT NULL,
    hip_conjuntival character varying(30) NOT NULL,
    exantema character varying(30) NOT NULL,
    dol_abdo_int_con character varying(30) NOT NULL,
    sang_act_mucosa character varying(30) NOT NULL,
    hipotension character varying(30) NOT NULL,
    artritis character varying(30) NOT NULL,
    edema_periart character varying(30) NOT NULL,
    cefalea character varying(30) NOT NULL,
    dolor_palpa_adbomen character varying(30) NOT NULL,
    irrita_somnolencia character varying(30) NOT NULL,
    dific_resp_extravasacion character varying(30) NOT NULL
);


ALTER TABLE public.fichas_dgvs OWNER TO postgres;

--
-- Name: hepatitisae; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.hepatitisae (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    nomyape character varying(150),
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    cedula character varying(15),
    dccion character varying(200),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    tipoloc numeric(1,0),
    pais character varying(100),
    celularr character varying(30),
    ocupacion character varying(150),
    dcciontraesc character varying(200),
    vacantihep numeric(1,0),
    fec1radosis date,
    fec2dadosis date,
    vaccarnet numeric(1,0),
    contpers numeric(1,0),
    trabajo numeric(1,0),
    fectrabajo date,
    familia numeric(1,0),
    fecfamilia date,
    jardin numeric(1,0),
    fecescuela date,
    salagrado character varying(200),
    comedor numeric(1,0),
    feccomedor date,
    club numeric(1,0),
    fecclub date,
    clubpiscina numeric(1,0),
    chabviv numeric(2,0),
    ccuartos numeric(2,0),
    cperscuarto numeric(2,0),
    agua numeric(1,0),
    excretas numeric(1,0),
    tipobanio numeric(1,0),
    tipobanioesp character varying(200),
    comparteviv numeric(1,0),
    fecinisint date,
    fec1racons date,
    establecons character varying(150),
    hospitalizado numeric(1,0),
    fechosp date,
    diagingre character varying(200),
    labotgo numeric(1,0),
    labtgovn character varying(200),
    labotgp numeric(1,0),
    labtgpvn character varying(200),
    labbvt character varying(200),
    labbvd character varying(200),
    labbvi character varying(200),
    rantihavigm numeric(1,0),
    reshavigm character varying(200),
    rantihavigg numeric(1,0),
    reshavigg character varying(200),
    fecegreso date,
    tipoegreso numeric(1,0),
    establecim character varying(150),
    fechanotif date,
    nomyapenot character varying(150),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3)
);


ALTER TABLE public.hepatitisae OWNER TO postgres;

--
-- Name: hepatitisbcd; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.hepatitisbcd (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    nomyape character varying(150),
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    cedula character varying(15),
    dccion character varying(200),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    tipoloc numeric(1,0),
    pais character varying(100),
    telefonor character varying(30),
    ocupacion character varying(150),
    dcciontraesc character varying(200),
    vacantihepa numeric(1,0),
    fecultdosis date,
    dcompleta numeric(1,0),
    vaccarnet numeric(1,0),
    dondecaso numeric(1,0),
    medinyecta numeric(1,0),
    drogasinye numeric(1,0),
    tatuajes numeric(1,0),
    acupuntura numeric(1,0),
    tratquirurgi numeric(1,0),
    tratdentario numeric(1,0),
    transfsangre numeric(1,0),
    hemodialisis numeric(1,0),
    sexovm numeric(1,0),
    sexovv numeric(1,0),
    multipareja numeric(1,0),
    sexosinprot numeric(1,0),
    sexoanal numeric(1,0),
    realotr character varying(200),
    trabsalud numeric(1,0),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3),
    madreposit numeric(1,0),
    inmunotrat numeric(1,0),
    vih numeric(1,0),
    tbc numeric(1,0),
    desnutrido numeric(1,0),
    alcohol numeric(1,0),
    fecinisint date,
    fec1racons date,
    estableccons character varying(150),
    hospitaliza numeric(1,0),
    fechosp date,
    diagingre character varying(200),
    fecegreso date,
    tipoegreso numeric(1,0),
    establecim character varying(150),
    tabotgo numeric(1,0),
    labtgovn character varying(200),
    labotgp numeric(1,0),
    labtgpvn character varying(200),
    labbvt character varying(200),
    labbvd character varying(200),
    labbvi character varying(200),
    labofa numeric(1,0),
    labfavn character varying(200),
    labogammagt numeric(1,0),
    labgamagtvn character varying(200),
    laboldh numeric(1,0),
    labldhvn character varying(200),
    rantivhaigm numeric(1,0),
    rantihbcigm numeric(1,0),
    rantihbctot numeric(1,0),
    rantihbs numeric(1,0),
    rhbsag numeric(1,0),
    rantivhdtot numeric(1,0),
    rantivhdigm numeric(1,0),
    rantivheigm numeric(1,0),
    rhbeag numeric(1,0),
    rvhcadn numeric(1,0),
    rvhcrna numeric(1,0),
    rantihbe numeric(1,0),
    rantihbc numeric(1,0),
    clasifcaso numeric(1,0),
    periodo numeric(1,0),
    fechanotif date,
    nomyapenot character varying(150),
    codregn character varying(2),
    subcregn character varying(3),
    coddistn character varying(3),
    codservn character varying(3)
);


ALTER TABLE public.hepatitisbcd OWNER TO postgres;

--
-- Name: histocompatibilidad1; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.histocompatibilidad1 (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    fechanotif date,
    nomyape character varying(150),
    fechanac date,
    cedula character varying(15),
    lugarnac character varying(150),
    gruposang character varying(1),
    parentesco character varying(100),
    obs character varying(250)
);


ALTER TABLE public.histocompatibilidad1 OWNER TO postgres;

--
-- Name: histocompatibilidad2; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.histocompatibilidad2 (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    fechanotif date,
    nomyape character varying(150),
    fechanac date,
    edad numeric(3,0),
    sexo numeric(1,0),
    hospital character varying(150),
    fechaing date,
    causadef character varying(150),
    gruposang character varying(1),
    rectrans numeric(1,0),
    tipotrans character varying(100),
    canttrans numeric(2,0),
    organos character varying(250),
    crosso1 character varying(100),
    crosso2 character varying(100),
    crosso3 character varying(100),
    crosso4 character varying(100),
    crosso5 character varying(100),
    coordinador character varying(150),
    fecharesol date
);


ALTER TABLE public.histocompatibilidad2 OWNER TO postgres;

--
-- Name: histocompatibilidad3; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.histocompatibilidad3 (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    fechanotif date,
    nomyape character varying(150),
    sexo numeric(1,0),
    fechanac date,
    cedula character varying(15),
    lugarnac character varying(100),
    telefono character varying(30),
    epdiabetes numeric(1,0),
    ephta numeric(1,0),
    eplupus numeric(1,0),
    epotra numeric(1,0),
    epotraesp numeric(1,0),
    gruposang character varying(1),
    rectrans numeric(1,0),
    canttrans numeric(2,0),
    cuandotrans character varying(50),
    voltrans numeric(5,0),
    rectrp numeric(1,0),
    cuandotrp character varying(50),
    quientrp character varying(100),
    tienehijos numeric(1,0),
    canthijos numeric(2,0),
    edadhijos character varying(100),
    tratdialisis numeric(1,0),
    cuandodial character varying(50),
    fecudial date,
    tipodial numeric(1,0),
    codserv character varying(3),
    medico character varying(150)
);


ALTER TABLE public.histocompatibilidad3 OWNER TO postgres;

--
-- Name: homebanking; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.homebanking (
    nroingreso numeric(10,0) NOT NULL,
    nrotransac character varying(30),
    banco character varying(100),
    fecha date,
    hora character varying(8),
    codempresa integer,
    monto numeric(10,0),
    estadu numeric(1,0),
    tipo numeric(1,0),
    nroexpediente numeric(10,0),
    codbco character varying(10),
    fechapago date,
    id character varying(50)
);


ALTER TABLE public.homebanking OWNER TO postgres;

--
-- Name: ingresocaja; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ingresocaja (
    nroingreso numeric(10,0) NOT NULL,
    nrorecibo numeric(10,0),
    nroreciboser character varying(20),
    reciboide character varying(150),
    dccion character varying(200),
    fecha date,
    hora character varying(8),
    formapago numeric(1,0),
    otrafp character varying(50),
    estado numeric(1,0),
    nrorecibo1 numeric(10,0),
    nroserie1 character varying(20),
    nrorecibo2 numeric(10,0),
    nroserie2 character varying(20),
    cedula character varying(15),
    nomyape character varying(150),
    nropaciente integer,
    codcaja character varying(10),
    codusu character varying(20),
    arqueado numeric(1,0),
    codservicio character varying(10),
    codanula character varying(10),
    observacion character varying(100),
    idapertura integer
);


ALTER TABLE public.ingresocaja OWNER TO postgres;

--
-- Name: iraginusitada; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.iraginusitada (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    nomyape character varying(150),
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    cedula character varying(15),
    dccion character varying(200),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    tipoloc numeric(1,0),
    pais character varying(100),
    telefonor character varying(30),
    ocupacion character varying(150),
    dcciontraesc character varying(200),
    vacantigripe numeric(1,0),
    vacuanio numeric(4,0),
    vaccarnet numeric(1,0),
    viajo15 numeric(1,0),
    paisviajo character varying(200),
    muniviajo character varying(200),
    contmrto numeric(1,0),
    lcontac character varying(200),
    contaves numeric(1,0),
    lcontaves character varying(200),
    trabsalud numeric(1,0),
    codregtrab character varying(2),
    subcregtrab character varying(3),
    coddisttrab character varying(3),
    codservtrab character varying(3),
    fecinisint date,
    fec1racons date,
    establecons character varying(150),
    antipiretico numeric(1,0),
    fecinitoma date,
    antiviral numeric(1,0),
    feciniantiv date,
    antibiot numeric(1,0),
    feciniantib date,
    fechosp date,
    diaghosp character varying(200),
    freccard character varying(30),
    frecresp character varying(30),
    pamin numeric(3,0),
    pamax numeric(3,0),
    temperat numeric(2,0),
    peso numeric(3,0),
    talla numeric(3,0),
    fec1ramtra date,
    primtraaspi numeric(1,0),
    primtraiso numeric(1,0),
    primtralav numeric(1,0),
    primtrasang numeric(1,0),
    ptimtraotr numeric(1,0),
    segmtraaspi numeric(1,0),
    segmtraiso numeric(1,0),
    segmtralav numeric(1,0),
    segmtrasang numeric(1,0),
    segmtraotr numeric(1,0),
    resifi character varying(200),
    respcr character varying(200),
    rechemo character varying(200),
    resotr character varying(200),
    fechanotif date,
    nomyapenot character varying(150),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3)
);


ALTER TABLE public.iraginusitada OWNER TO postgres;

--
-- Name: labdifteria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.labdifteria (
    nronotif numeric(10,0) NOT NULL,
    nromuestra numeric(2,0) NOT NULL,
    nordentra character varying(20),
    tipomuestra numeric(1,0),
    fectoma date,
    laboratorio character varying(150),
    fecenvio date,
    fecrecep date,
    idlabo character varying(20),
    tipoprueba numeric(1,0),
    resultado numeric(1,0),
    toxigenicidad numeric(1,0),
    fecresul date
);


ALTER TABLE public.labdifteria OWNER TO postgres;

--
-- Name: labparalisisav; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.labparalisisav (
    nronotif numeric(10,0) NOT NULL,
    nromuestra numeric(2,0) NOT NULL,
    fectoma date,
    fecenvio date,
    laboratorio character varying(150),
    fecrecep date,
    idlabo character varying(20),
    avresul numeric(1,0),
    fecresul date
);


ALTER TABLE public.labparalisisav OWNER TO postgres;

--
-- Name: labparalisisitd; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.labparalisisitd (
    nronotif numeric(10,0) NOT NULL,
    nromuestra numeric(2,0) NOT NULL,
    fecenvio date,
    laboratorio character varying(150),
    fecrecep date,
    difitraatipr numeric(1,0),
    fecitd date,
    difitraatipd numeric(1,0),
    resdefinit character varying(200)
);


ALTER TABLE public.labparalisisitd OWNER TO postgres;

--
-- Name: labrubeola; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.labrubeola (
    nronotif numeric(10,0) NOT NULL,
    nromuestra numeric(2,0) NOT NULL,
    nordentra character varying(20),
    tipomuestra numeric(1,0),
    fecmuestra date,
    laboratorio character varying(150),
    fecenvio date,
    fecrecep date,
    idlabo character varying(20),
    tipoprueba numeric(1,0),
    antigeno numeric(1,0),
    resultado numeric(1,0),
    fecresul date
);


ALTER TABLE public.labrubeola OWNER TO postgres;

--
-- Name: labvaricela; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.labvaricela (
    nronotif numeric(10,0) NOT NULL,
    nromuestra numeric(2,0) NOT NULL,
    nordentra character varying(20),
    tipomuestra numeric(1,0),
    fecmuestra date,
    laboratorio character varying(150),
    fecenvio date,
    fecrecep date,
    idlabo character varying(20),
    tipoprueba numeric(1,0),
    antigeno numeric(1,0),
    resultado numeric(1,0),
    fecresult date
);


ALTER TABLE public.labvaricela OWNER TO postgres;

--
-- Name: lamimalaria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lamimalaria (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    norden numeric(5,0) NOT NULL,
    codlamina character varying(10),
    resultado character varying(100),
    especie character varying(100),
    densidadpar numeric(1,0),
    puntaje numeric(10,2),
    resulprevisto character varying(100)
);


ALTER TABLE public.lamimalaria OWNER TO postgres;

--
-- Name: leishmaniosismucosa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.leishmaniosismucosa (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    fechanotif date,
    nomyapenot character varying(150),
    cargonotif character varying(100),
    codserv character varying(3),
    codreg character varying(2),
    coddist character varying(3),
    nomyape character varying(150),
    sexo numeric(1,0),
    fechanac date,
    edad numeric(3,0),
    cedula character varying(15),
    dccion character varying(200),
    referencia character varying(250),
    coddistref character varying(3),
    localidad character varying(100),
    coddptor character varying(2),
    nacionalidad character varying(100),
    ocupacion character varying(100),
    esetnia numeric(1,0),
    codetnia character varying(5),
    loccontagio character varying(100),
    coddistcon character varying(3),
    coddptocon character varying(2),
    fechacons date,
    peso numeric(10,2),
    lmtabique numeric(1,0),
    lmlabios numeric(1,0),
    lmpaladar numeric(1,0),
    lmfaringe numeric(1,0),
    lmlaringe numeric(1,0),
    lmmutilaci numeric(1,0),
    tevollesion numeric(5,0),
    cicatrices numeric(1,0),
    tlescutanea numeric(5,0),
    tantleishman numeric(1,0),
    otrcompli character varying(100),
    frcardiaco numeric(1,0),
    frhepatico numeric(1,0),
    frrenales numeric(1,0),
    frhta numeric(1,0),
    frotro numeric(1,0),
    frotroesp character varying(100),
    casonuevo numeric(1,0),
    recidiva numeric(1,0),
    seguntrat numeric(1,0),
    drog2dotrat numeric(1,0),
    retorno numeric(1,0),
    rmontenegro numeric(1,0),
    diamindu numeric(5,0),
    fecidrm date,
    nomyapeidrm character varying(150),
    servidrm character varying(100),
    metodo character varying(100),
    fechares date,
    nomyaperea character varying(150),
    servserolo character varying(100),
    otrdiag character varying(100),
    entregamed numeric(1,0),
    hospitaliza numeric(1,0),
    fechahosp date,
    fechatrat date,
    esqtrata numeric(1,0),
    nomyapereatra character varying(150),
    servrealiza character varying(100),
    drogautil character varying(100),
    dosisutil character varying(100),
    diastrat numeric(3,0),
    viaadmin numeric(1,0),
    efadverso numeric(1,0),
    interrutrat numeric(1,0),
    motintertrat character varying(100),
    terapantibio numeric(1,0),
    antibioutil character varying(100),
    otrasterap character varying(100),
    regulatrat numeric(1,0),
    clasiffinal numeric(1,0),
    clasfinalesp character varying(100),
    paiscontag2 character varying(100),
    coddptocon2 character varying(2),
    coddistcon2 character varying(3),
    locpcontag2 character varying(100),
    evolcaso numeric(1,0),
    fechaobi date,
    fechacierre date,
    obs character varying(250)
);


ALTER TABLE public.leishmaniosismucosa OWNER TO postgres;

--
-- Name: leishmaniosisvh; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.leishmaniosisvh (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3),
    fechacap date,
    tdocumento numeric(1,0),
    cedula character varying(15),
    nrosemana numeric(2,0),
    nropsemana numeric(10,0),
    responsable character varying(150),
    fechanotif date,
    pnombre character varying(30),
    snombre character varying(30),
    papellido character varying(30),
    sapellido character varying(30),
    apellidocas character varying(30),
    nrohclinica numeric(10,0),
    sexo numeric(1,0),
    fechanac date,
    edad numeric(3,0),
    coddptor character varying(2),
    coddistr character varying(3),
    tipoarear numeric(1,0),
    codbarrior character varying(3),
    otrobarrior character varying(100),
    referenciar character varying(250),
    dccionr character varying(200),
    telefonor character varying(200),
    nommadre character varying(150),
    vivedesdefec date,
    dccionant character varying(200),
    coddptovd character varying(2),
    coddistvd character varying(3),
    codbarrio character varying(3),
    otrobarrio character varying(100),
    telefono character varying(30),
    codpais character varying(5),
    viviohfec date,
    tipoareav numeric(1,0),
    viajo12m numeric(1,0),
    codpaisv character varying(5),
    coddptovia character varying(2),
    coddistvia character varying(3),
    coddptovia2 character varying(2),
    coddistvia2 character varying(3),
    codpaisv3 character varying(5),
    coddptovia3 character varying(2),
    coddistvia3 character varying(3),
    finisin date,
    peso numeric(10,2),
    talla numeric(3,0),
    estadoing numeric(1,0),
    temperat numeric(6,2),
    adelgaza numeric(1,0),
    hemorragia numeric(1,0),
    desnutricion numeric(1,0),
    edema numeric(1,0),
    desgano numeric(1,0),
    adenomegalia numeric(1,0),
    dcignorar numeric(1,0),
    tambazo numeric(3,0),
    tamhigado numeric(3,0),
    hemoglobina numeric(5,0),
    globblanco numeric(10,0),
    neutrofilos numeric(6,2),
    plaquetas numeric(10,0),
    coinfecvih numeric(1,0),
    coinfectbc numeric(1,0),
    coinfecpulm numeric(1,0),
    coinfotr numeric(1,0),
    coinfotresp character varying(100),
    metsero1 character varying(100),
    metserores1 numeric(1,0),
    metseroes2 character varying(100),
    metserores2 numeric(1,0),
    diaglabofec date,
    metparases1 character varying(100),
    metparasres1 numeric(1,0),
    metparases2 character varying(100),
    metparasres2 numeric(1,0),
    metparasmat1 character varying(100),
    metparasmat2 character varying(100),
    trathospital numeric(1,0),
    tratfec date,
    codregtrat character varying(2),
    subcregtrat character varying(3),
    coddisttrat character varying(3),
    codservtrat character varying(3),
    siguetrat numeric(1,0),
    finitrat date,
    drogautil character varying(100),
    drogadosis character varying(50),
    diastrat numeric(3,0),
    tratvia numeric(1,0),
    tratefadver numeric(1,0),
    tratinterrup numeric(1,0),
    tratmotinter character varying(100),
    tratdrogaalt character varying(100),
    tratdrogados character varying(50),
    tratdrogaald numeric(3,0),
    tratviadir numeric(1,0),
    tratefadvda numeric(1,0),
    trattaantib numeric(1,0),
    tratantibesp character varying(100),
    trattransfus numeric(1,0),
    tratotrterap character varying(100),
    finalcaso numeric(1,0),
    fincasoclasif character varying(100),
    codpaiscont character varying(5),
    coddptoco character varying(2),
    coddistco character varying(3),
    codbarrioco character varying(3),
    otrobarrioco character varying(100),
    conccaso numeric(1,0),
    fechaobi date,
    fechacierre date,
    obs character varying(250)
);


ALTER TABLE public.leishmaniosisvh OWNER TO postgres;

--
-- Name: malaria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.malaria (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    fechamtra date,
    fechaenvio date,
    responsable character varying(150),
    codserv character varying(3),
    codreg character varying(2),
    coddist character varying(3),
    fechanotif date,
    nomyapenot character varying(150),
    cargoresp character varying(100),
    nomyape character varying(150),
    sexo numeric(1,0),
    edad numeric(3,0),
    muestra character varying(100),
    resultado numeric(1,0),
    especie numeric(1,0),
    especieotr character varying(100),
    densidadpar character varying(100),
    tirasrap numeric(1,0),
    hrpii numeric(1,0),
    panldh numeric(1,0),
    otratecnica character varying(100),
    resotratec numeric(100,0),
    respdiag numeric(100,0),
    fechadiag date,
    gotagrtam character varying(1),
    gotagrtames character varying(100),
    gotagrubi character varying(1),
    gotagrubies character varying(100),
    extfinotam character varying(1),
    extfinotames character varying(100),
    extfinubi character varying(1),
    extfinoubies character varying(100),
    extfinocal character varying(1),
    extfinocales character varying(100),
    colordes character varying(1),
    colordees character varying(100),
    colorton character varying(1),
    colortones character varying(100),
    colorpre character varying(1),
    colorprees character varying(100),
    medico character varying(100),
    obs character varying(250)
);


ALTER TABLE public.malaria OWNER TO postgres;

--
-- Name: matdengue; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.matdengue (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    nromuestra character varying(20) NOT NULL,
    cutoff character varying(100),
    absobancia character varying(100),
    resultado character varying(100),
    fecha date,
    puntaje numeric(10,2),
    resulprevisto character varying(100)
);


ALTER TABLE public.matdengue OWNER TO postgres;

--
-- Name: matinfluenza; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.matinfluenza (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    nrolamina character varying(100) NOT NULL,
    resultado character varying(100),
    virus character varying(100),
    fechaproc date,
    puntaje numeric(10,2),
    resulprevisto character varying(100)
);


ALTER TABLE public.matinfluenza OWNER TO postgres;

--
-- Name: matrotavirus; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.matrotavirus (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    nromuestra character varying(20) NOT NULL,
    metodo character varying(100),
    fechaproc date,
    reactmarca character varying(100),
    reactnro character varying(20),
    recatvto character varying(8),
    instrumento character varying(100),
    longonda numeric(10,2),
    resultado character varying(100),
    puntaje numeric(10,2),
    resulprevisto character varying(100)
);


ALTER TABLE public.matrotavirus OWNER TO postgres;

--
-- Name: medicos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.medicos (
    codmedico character varying(10) NOT NULL,
    nroregistro character varying(10),
    tipoprof character varying(100),
    nomyape character varying(150),
    estado numeric(1,0)
);


ALTER TABLE public.medicos OWNER TO postgres;

--
-- Name: meningitis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.meningitis (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    nomyapenot character varying(150),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3),
    fechahosp date,
    fechacap date,
    nomyape character varying(150),
    cedula character varying(15),
    nrohclinica character varying(20),
    fechanac date,
    edad numeric(3,0),
    sexo numeric(1,0),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    dccion character varying(200),
    nommadre character varying(150),
    celularmad character varying(30),
    centroeduca character varying(150),
    vaccarnet numeric(1,0),
    vacantihib numeric(1,0),
    vdoshibpenta character varying(30),
    fecvacpenta date,
    tvachibpenta character varying(100),
    vacantineumo numeric(1,0),
    vacaneudos character varying(30),
    fecvacantineu date,
    vactiponeu character varying(100),
    vacantimenin numeric(1,0),
    vacmendos character varying(30),
    fecvacantimen date,
    vactipomen character varying(100),
    fecinisint date,
    diagingre character varying(200),
    enfercronica numeric(1,0),
    enfcronica character varying(200),
    antibiotusem numeric(1,0),
    antibusem character varying(200),
    casosimilar numeric(1,0),
    nombnexo character varying(200),
    tomahemo numeric(1,0),
    fecmuestrah date,
    tomalcr numeric(1,0),
    fecmtralcr date,
    gramhemo character varying(200),
    gramlcr character varying(200),
    latex character varying(200),
    citolcr character varying(200),
    leuco character varying(200),
    pmn character varying(200),
    mn character varying(200),
    glucosa character varying(200),
    proteinas character varying(200),
    hemo numeric(1,0),
    hemohi numeric(1,0),
    hemospn numeric(1,0),
    hemohm numeric(1,0),
    hemoning numeric(1,0),
    hemootr numeric(1,0),
    hemootresp character varying(200),
    fecresulh date,
    lcr numeric(1,0),
    lcrhi numeric(1,0),
    lcrspn numeric(1,0),
    lcrnm numeric(1,0),
    lcrning numeric(1,0),
    lcrotr numeric(1,0),
    lcrotresp character varying(200),
    fecresulcr date,
    pcrhemosan numeric(1,0),
    pcrhemohi numeric(1,0),
    pcrhemospn numeric(1,0),
    pcrhemonm numeric(1,0),
    pcrhemoning numeric(1,0),
    pcrhemootr numeric(1,0),
    pcrhemootre character varying(200),
    fecresulpcr date,
    pcrhemsero character varying(200),
    pcrbac numeric(1,0),
    pacbachi numeric(1,0),
    pcrbacspn numeric(1,0),
    pcrbacnm numeric(1,0),
    pcrbacning numeric(1,0),
    pcrbacotr numeric(1,0),
    pcrbacotre character varying(200),
    fecresbac date,
    pcrbacsero character varying(200),
    pcrdelcr numeric(1,0),
    pcrdelcrtip numeric(1,0),
    pcrdelcrtipe character varying(200),
    tintachina character varying(200),
    ingresouci numeric(1,0),
    fecinguci date,
    fecegruci date,
    tipoegreso numeric(1,0),
    fecegreso date,
    referido numeric(1,0),
    establecual character varying(150),
    diagegre character varying(200),
    clasfinal numeric(1,0)
);


ALTER TABLE public.meningitis OWNER TO postgres;

--
-- Name: mensajes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mensajes (
    nromsg numeric(15,0) NOT NULL,
    fecha date NOT NULL,
    hora character varying(8) NOT NULL,
    codusu character varying(20) NOT NULL,
    codservicio character varying(10) NOT NULL,
    sms numeric(1,0),
    email numeric(1,0),
    alerta numeric(1,0),
    estadosms numeric(1,0),
    estadoemail numeric(1,0),
    estadoalerta numeric(1,0)
);


ALTER TABLE public.mensajes OWNER TO postgres;

--
-- Name: metodos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.metodos (
    codmetodo character varying(10) NOT NULL,
    nommetodo character varying(200)
);


ALTER TABLE public.metodos OWNER TO postgres;

--
-- Name: microorganismos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.microorganismos (
    codmicroorg character varying(10) NOT NULL,
    nommicroorg character varying(100),
    codexterno character varying(50)
);


ALTER TABLE public.microorganismos OWNER TO postgres;

--
-- Name: monitoreo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.monitoreo (
    codmonitoreo integer NOT NULL,
    codreg character varying NOT NULL,
    subreg character varying NOT NULL,
    laboratorio character varying(150) NOT NULL,
    codsemana integer NOT NULL,
    horario character varying(100) NOT NULL,
    cantidad_pacientes numeric NOT NULL,
    cantidad_paciente_bio numeric NOT NULL,
    pruebas_total numeric NOT NULL,
    numero_muestras_bio numeric NOT NULL,
    pcr numeric NOT NULL,
    elisa_igc numeric NOT NULL,
    elisa_igm numeric NOT NULL,
    elisa_ns1 numeric NOT NULL,
    muestras_lcsp_enviadas numeric NOT NULL,
    paciente_hospitalizado numeric NOT NULL,
    paciente_obito numeric NOT NULL,
    paciente_ambulatoria numeric NOT NULL,
    personal_activo numeric NOT NULL,
    bioquimico numeric NOT NULL,
    tecnico numeric NOT NULL,
    apoyo_administrativo numeric NOT NULL,
    bioquimico_activo numeric NOT NULL,
    stock_epidemiologico numeric NOT NULL,
    rcpcr_epi numeric NOT NULL,
    elisa_ns1_epi numeric NOT NULL,
    elisa_igc_epi numeric NOT NULL,
    elisa_igm_epi numeric NOT NULL,
    hemograma numeric,
    hepatograma numeric,
    observacion character varying NOT NULL,
    responsable_nombre character varying NOT NULL,
    responsable_contacto character varying NOT NULL,
    responsable_email character varying NOT NULL,
    codusuario character varying NOT NULL,
    fecha timestamp without time zone NOT NULL,
    inmuno numeric,
    inmuno_epi numeric
);


ALTER TABLE public.monitoreo OWNER TO postgres;

--
-- Name: monitoreo_codmonitoreo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.monitoreo_codmonitoreo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.monitoreo_codmonitoreo_seq OWNER TO postgres;

--
-- Name: monitoreo_codmonitoreo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.monitoreo_codmonitoreo_seq OWNED BY public.monitoreo.codmonitoreo;


--
-- Name: motivoanulacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.motivoanulacion (
    codanula character varying(10) NOT NULL,
    nomanula character varying(250)
);


ALTER TABLE public.motivoanulacion OWNER TO postgres;

--
-- Name: motivorechazo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.motivorechazo (
    codrechazo character varying(10) NOT NULL,
    nomrechazo character varying(250)
);


ALTER TABLE public.motivorechazo OWNER TO postgres;

--
-- Name: nobligatorias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.nobligatorias (
    nronotif numeric(10,0) NOT NULL,
    nordentra integer,
    nropaciente numeric(10,0),
    codenferm character varying(50),
    codservicio character varying(10),
    codusu character varying(20)
);


ALTER TABLE public.nobligatorias OWNER TO postgres;

--
-- Name: notifmalaria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.notifmalaria (
    nronotif numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    nrocontrol numeric(10,0) NOT NULL,
    fecha date,
    resultado character varying(100),
    densidadpar character varying(100),
    responsable character varying(150)
);


ALTER TABLE public.notifmalaria OWNER TO postgres;

--
-- Name: opciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.opciones (
    codopc character varying(10) NOT NULL,
    nomopc character varying(200),
    tipo numeric(1,0),
    ayuda character varying(250)
);


ALTER TABLE public.opciones OWNER TO postgres;

--
-- Name: opcionroles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.opcionroles (
    codrol character varying(10) NOT NULL,
    codopc character varying(10) NOT NULL,
    modo numeric(1,0)
);


ALTER TABLE public.opcionroles OWNER TO postgres;

--
-- Name: ordenagrupado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ordenagrupado (
    grupo character varying(10) NOT NULL,
    fecha date,
    nordentra integer NOT NULL,
    codusu character varying(20),
    codestudio character varying(10) NOT NULL
);


ALTER TABLE public.ordenagrupado OWNER TO postgres;

--
-- Name: seq_ordtrabajo; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_ordtrabajo
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_ordtrabajo OWNER TO postgres;

--
-- Name: ordtrabajo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ordtrabajo (
    nordentra integer DEFAULT nextval('public.seq_ordtrabajo'::regclass) NOT NULL,
    codservicio character varying(10) NOT NULL,
    codusu character varying(20),
    nropaciente numeric(10,0),
    fecharec date,
    horarec character varying(8),
    fechasal date,
    horasal character varying(8),
    urgente numeric(1,0),
    nroturno character varying(10),
    codorigen character varying(10),
    codservrem character varying(10),
    codservder character varying(10),
    codmedico character varying(10),
    recitacion numeric(1,0),
    retira numeric(1,0),
    obs character varying(250),
    atendido numeric(1,0),
    cod_dgvs bigint,
    nro_toma character varying,
    nom_servicio character varying(500),
    laboratorio bigint,
    orden_dgvs character varying(20),
    nom_proceso character(300),
    nroficha integer,
    idlab integer,
    id_secciones_ficha integer,
    cod_dgvs2 integer
);


ALTER TABLE public.ordtrabajo OWNER TO postgres;

--
-- Name: origenpaciente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.origenpaciente (
    codorigen character varying(10) NOT NULL,
    nomorigen character varying(100)
);


ALTER TABLE public.origenpaciente OWNER TO postgres;

--
-- Name: otreventos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.otreventos (
    nronotif numeric(10,0) NOT NULL,
    nordentra integer,
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3),
    eventrepo character varying(200),
    afectados character varying(200),
    pobbarrio numeric(10,0),
    tipoloc numeric(1,0),
    carsanitaria character varying(200),
    econppal character varying(200),
    fecocur date,
    tipoocur character varying(200),
    coddptooc character varying(2),
    coddistoc character varying(3),
    nrocasos numeric(10,0),
    nrohosps numeric(10,0),
    nrodefs numeric(10,0),
    fecinieven date,
    fecucaso date,
    caredad character varying(200),
    carsexo character varying(200),
    carocup character varying(200),
    carviaje character varying(200),
    carotros character varying(200),
    fecsimilar date,
    antevento character varying(200),
    antnafec numeric(10,0),
    sintomas character varying(200),
    carclinic character varying(200),
    tratamiento character varying(200),
    evolucion character varying(200),
    diagsospecha character varying(200),
    tipomuestra character varying(200),
    nromuestra numeric(10,0),
    labenvio character varying(120),
    fecenvio date,
    fecresul date,
    mambient character varying(200),
    malim character varying(200),
    manimal character varying(200),
    mreserv character varying(200),
    mrecol character varying(200),
    laboenvio character varying(150),
    fecresul2 date,
    resultado character varying(200),
    mectransmi character varying(200),
    accctrl character varying(200),
    continvest character varying(200)
);


ALTER TABLE public.otreventos OWNER TO postgres;

--
-- Name: seq_paciente; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_paciente
    START WITH 5
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_paciente OWNER TO postgres;

--
-- Name: paciente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.paciente (
    nropaciente numeric(10,0) DEFAULT nextval('public.seq_paciente'::regclass) NOT NULL,
    fechareg date,
    tdocumento numeric(1,0),
    cedula character varying(20),
    pnombre character varying(30),
    snombre character varying(30),
    papellido character varying(30),
    sapellido character varying(30),
    sexo numeric(1,0),
    fechanac date,
    edada numeric(3,0),
    edadm numeric(3,0),
    ecivil numeric(1,0),
    nacionalidad character varying(100),
    telefono character varying(30),
    email character varying(50),
    codexterno character varying(20),
    estado numeric(1,0),
    dccionr character varying(200),
    paisr character varying(100),
    coddptor character varying(2),
    coddistr character varying(3),
    nomyapefam character varying(150),
    telefonof character varying(30),
    celularf character varying(50),
    obs character varying(250),
    fechauact date,
    codusup character varying(20),
    tb numeric(1,0),
    cod_dgvs bigint,
    codetnia character varying(5),
    esetnia numeric(1,0),
    cod_dgvs2 integer
);


ALTER TABLE public.paciente OWNER TO postgres;

--
-- Name: paciente_mal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.paciente_mal (
    nropaciente numeric(10,0) DEFAULT nextval('public.seq_paciente'::regclass) NOT NULL,
    fechareg date,
    tdocumento numeric(1,0),
    cedula character varying(15),
    pnombre character varying(30),
    snombre character varying(30),
    papellido character varying(30),
    sapellido character varying(30),
    sexo numeric(1,0),
    fechanac date,
    edada numeric(3,0),
    edadm numeric(3,0),
    ecivil numeric(1,0),
    nacionalidad character varying(100),
    telefono character varying(30),
    email character varying(50),
    codexterno character varying(20),
    estado numeric(1,0),
    dccionr character varying(200),
    paisr character varying(100),
    coddptor character varying(2),
    coddistr character varying(3),
    nomyapefam character varying(150),
    telefonof character varying(30),
    celularf character varying(50),
    obs character varying(250),
    fechauact date,
    codusup character varying(20),
    tb numeric(1,0),
    cod_dgvs bigint,
    codetnia character varying(5),
    esetnia numeric(1,0)
);


ALTER TABLE public.paciente_mal OWNER TO postgres;

--
-- Name: paralisisfla; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.paralisisfla (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    sospechapol numeric(1,0),
    sospechasx numeric(1,0),
    sospechaotr numeric(1,0),
    sospechaotre character varying(200),
    fechacons date,
    fechacap date,
    fechanotif date,
    nomyapenot character varying(150),
    telefononot character varying(30),
    celularnot character varying(30),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3),
    subsector numeric(1,0),
    subsectoresp character varying(150),
    conocio numeric(1,0),
    conociootr character varying(150),
    cedula character varying(15),
    nomyape character varying(150),
    fechanac date,
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    nacionalidad character varying(100),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    dccion character varying(200),
    referencia character varying(200),
    telefonor character varying(30),
    celularr character varying(30),
    tipoloc numeric(1,0),
    esetnia numeric(1,0),
    codetnia character varying(5),
    ocupacion character varying(150),
    dcciontraesc character varying(200),
    nommadre character varying(150),
    cedulamadre character varying(15),
    vacfte numeric(1,0),
    tipovac numeric(1,0),
    ndosis character varying(30),
    fecvac1ra date,
    fecvac2da date,
    fecvac3ra date,
    fecvacref1 date,
    fecvacref2 date,
    codregvac character varying(2),
    coddistvac character varying(3),
    codservvac character varying(3),
    sgbpfa numeric(1,0),
    fecvisita date,
    prodfiebre numeric(1,0),
    prodrespir numeric(1,0),
    progastro character varying(200),
    fecinipar date,
    fiebreini numeric(1,0),
    parcraneal numeric(1,0),
    parrespirat numeric(1,0),
    parprogres numeric(1,0),
    tinstaldias numeric(4,0),
    mbrazoder numeric(1,0),
    mbrazoizq numeric(1,0),
    mpiernader numeric(1,0),
    mpiernaizq numeric(1,0),
    lbrazoder numeric(1,0),
    lbrazoizq numeric(1,0),
    lpiernader numeric(1,0),
    lpiernaizq numeric(1,0),
    rbrazoder numeric(1,0),
    rbrazoizq numeric(1,0),
    rpiernader numeric(1,0),
    rpiernaizq numeric(1,0),
    sbrazoder numeric(1,0),
    sbrazoizq numeric(1,0),
    spiernader numeric(1,0),
    spiernaizq numeric(1,0),
    hospitaliza numeric(1,0),
    codreghos character varying(2),
    coddisthos character varying(3),
    codservhos character varying(3),
    fecadmin date,
    diasinter numeric(3,0),
    nrohclinica character varying(20),
    defuncion numeric(1,0),
    codregdef character varying(2),
    coddistdef character varying(3),
    codservdef character varying(3),
    fecdefun date,
    defcausa character varying(200),
    contacto30 numeric(1,0),
    feccontact date,
    confirmado numeric(1,0),
    feccaso date,
    viajo30 numeric(1,0),
    dondeviajo character varying(200),
    fecviaje date,
    segui30 numeric(1,0),
    eval60 numeric(1,0),
    fecseguimd date,
    fecseguimh date,
    paralresidu numeric(1,0),
    atrofiamusc numeric(1,0),
    amg numeric(1,0),
    fecdatos date,
    resultado character varying(200),
    nommedico character varying(200),
    nroregistro character varying(20),
    fecfinal date,
    clasfinal numeric(1,0),
    critclasif numeric(1,0),
    diagfinal numeric(1,0)
);


ALTER TABLE public.paralisisfla OWNER TO postgres;

--
-- Name: parotiditis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.parotiditis (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    fechacons date,
    fechacap date,
    fechanotif date,
    nomyapenot character varying(150),
    telefononot character varying(30),
    celularnot character varying(30),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3),
    subsector numeric(1,0),
    subsectoresp character varying(150),
    conocio numeric(1,0),
    conociootr character varying(150),
    cedula character varying(15),
    nomyape character varying(150),
    fechanac date,
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    nacionalidad character varying(100),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    dccion character varying(200),
    referencia character varying(200),
    telefonor character varying(30),
    celularr character varying(30),
    tipoloc numeric(1,0),
    esetnia numeric(1,0),
    codetnia character varying(5),
    ocupacion character varying(150),
    dcciontraesc character varying(200),
    nommadre character varying(150),
    cedulamadre character varying(15),
    vacfte numeric(1,0),
    vacspr numeric(1,0),
    ndosis character varying(30),
    vacfec1ra date,
    vacfecref date,
    vacfecadi date,
    codregvac character varying(2),
    coddistvac character varying(3),
    codservvac character varying(3),
    fecinisint date,
    hospitaliza numeric(1,0),
    codreghos character varying(2),
    coddisthos character varying(3),
    codservhos character varying(3),
    fechosp date,
    diasinter numeric(3,0),
    nrohclinica character varying(20),
    tipoegreso numeric(1,0),
    altadesc character varying(200),
    fecalta date,
    tratantobiot character varying(200),
    tratantibdos character varying(200),
    tratfec date,
    tratotrmed character varying(200),
    tratotrmedds character varying(200),
    tratfecom date,
    fecvisita date,
    contotrcaso numeric(1,0),
    feccontact date,
    otraspers numeric(1,0),
    cantpers numeric(10,0),
    viajo1225 numeric(1,0),
    dondeviajo character varying(200),
    fecviaje date,
    clasfinal numeric(1,0),
    fecfinal date
);


ALTER TABLE public.parotiditis OWNER TO postgres;

--
-- Name: perfiles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.perfiles (
    codusu character varying(20) NOT NULL,
    codopc character varying(10) NOT NULL,
    modo numeric(1,0)
);


ALTER TABLE public.perfiles OWNER TO postgres;

--
-- Name: plantillaplan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.plantillaplan (
    codplatilla character varying(10) NOT NULL,
    nomplatilla character varying(200)
);


ALTER TABLE public.plantillaplan OWNER TO postgres;

--
-- Name: plantillaplandet; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.plantillaplandet (
    codplatilla character varying(10) NOT NULL,
    posicion numeric(2,0) NOT NULL,
    columna character varying(20)
);


ALTER TABLE public.plantillaplandet OWNER TO postgres;

--
-- Name: plantrabajo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.plantrabajo (
    nroplan numeric(10,0) NOT NULL,
    codservicio character varying(10) NOT NULL,
    codarea character varying(10) NOT NULL,
    codsector character varying(10) NOT NULL,
    fecha date NOT NULL,
    nordentra integer,
    nroestudio character varying(20),
    nropaciente numeric(10,0),
    codusu character varying(20),
    codplantilla character varying(10)
);


ALTER TABLE public.plantrabajo OWNER TO postgres;

--
-- Name: pregunta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pregunta (
    nroeval numeric(10,0) NOT NULL,
    idpregunta numeric(10,0) NOT NULL,
    fecharegistro date,
    descripcio character varying(200),
    puntaje numeric(5,2),
    terminado numeric(1,0) DEFAULT 1,
    tipo character varying(2),
    reporte character varying(200),
    referencia character(200)
);


ALTER TABLE public.pregunta OWNER TO postgres;

--
-- Name: preguntaedcontinua; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.preguntaedcontinua (
    nropregunta numeric(2,0) NOT NULL,
    respuesta character varying(30),
    textopregunta character varying(300)
);


ALTER TABLE public.preguntaedcontinua OWNER TO postgres;

--
-- Name: procesoresultado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.procesoresultado (
    nordentra integer NOT NULL,
    nroestudio character varying(20) NOT NULL,
    idmuestra character varying(20) NOT NULL,
    codproceso character varying(10),
    fecha date,
    hora character varying(8)
);


ALTER TABLE public.procesoresultado OWNER TO postgres;

--
-- Name: procesos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.procesos (
    codproceso character varying(10) NOT NULL,
    nomproceso character varying(100),
    codopc character varying(10),
    textobase character varying(250)
);


ALTER TABLE public.procesos OWNER TO postgres;

--
-- Name: psitacosis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.psitacosis (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    nomyape character varying(150),
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    cedula character varying(15),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    tipoloc numeric(1,0),
    pais character varying(100),
    telefonor character varying(30),
    celularr character varying(30),
    ocupacion character varying(150),
    dccionte character varying(200),
    contaves numeric(1,0),
    contcasa numeric(1,0),
    conttrabajo numeric(1,0),
    contotr numeric(1,0),
    tipoave character varying(200),
    avesenfer numeric(1,0),
    avescompr numeric(1,0),
    compvet numeric(1,0),
    compferia numeric(1,0),
    compotr numeric(1,0),
    dcompra character varying(200),
    contpers numeric(1,0),
    lcontacto character varying(200),
    fecinisint date,
    fec1racons date,
    establecaten character varying(150),
    fechosp date,
    radiologia character varying(200),
    tratamiento numeric(1,0),
    drogas character varying(200),
    laboratorio character varying(150),
    fec1ramuest date,
    mat1ramtra character varying(200),
    met1ramtra character varying(200),
    res1ramtra character varying(200),
    fec2damuest date,
    mat2damtra character varying(200),
    met2damtra character varying(200),
    res2damtra character varying(200),
    fecegreso date,
    tipoegreso numeric(1,0),
    codregtran character varying(2),
    coddisttran character varying(3),
    codservtran character varying(3),
    fechanotif date,
    nomyapenot character varying(150),
    codreg character varying(2),
    coddist character varying(3),
    codserv character varying(3)
);


ALTER TABLE public.psitacosis OWNER TO postgres;

--
-- Name: rangoedad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rangoedad (
    cgrupoedad character varying(10) NOT NULL,
    posicion numeric(2,0) NOT NULL,
    desdeedad numeric(3,0),
    hastaedad numeric(3,0),
    tipo numeric(1,0)
);


ALTER TABLE public.rangoedad OWNER TO postgres;

--
-- Name: reactsifilis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reactsifilis (
    nroeval numeric(10,0) NOT NULL,
    rectivo character varying(100) NOT NULL,
    vdrlmarcalot character varying(200),
    vdrlvto date,
    tphamarcalot character varying(200),
    tphavto date,
    ftaabsmarcalo character varying(200),
    ftaabsvto date,
    testrmarcalot character varying(200),
    testrvto date,
    otromarcalot character varying(200),
    otrovto date
);


ALTER TABLE public.reactsifilis OWNER TO postgres;

--
-- Name: rechazados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rechazados (
    grupo character varying(10) NOT NULL,
    nromuestra character varying(20) NOT NULL,
    fecharechazo date,
    codrechazo character varying(10),
    codusu character varying(20),
    nropaciente numeric(10,0),
    obs character varying(250)
);


ALTER TABLE public.rechazados OWNER TO postgres;

--
-- Name: recibos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.recibos (
    nroingreso numeric(10,0) NOT NULL,
    nrorecibo numeric(10,0),
    nroreciboser character varying(20),
    norden numeric(2,0) NOT NULL,
    codarancel character varying(10),
    monto numeric(10,0),
    fecha date,
    exonerado numeric(1,0),
    cantidad numeric(5,0)
);


ALTER TABLE public.recibos OWNER TO postgres;

--
-- Name: regiones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.regiones (
    codreg character varying(5) NOT NULL,
    subcreg character varying(5) NOT NULL,
    nomreg character varying(255) DEFAULT NULL::character varying,
    dire character varying(255) DEFAULT NULL::character varying,
    dccionpr character varying(255) DEFAULT NULL::character varying,
    nrocasa character varying(100) DEFAULT NULL::character varying,
    dccione1 character varying(100) DEFAULT NULL::character varying,
    dccione2 character varying(100) DEFAULT NULL::character varying,
    dpto double precision,
    dist double precision,
    barr double precision,
    desbarr character varying(255) DEFAULT NULL::character varying,
    teleflb character varying(100) DEFAULT NULL::character varying,
    telefce character varying(100) DEFAULT NULL::character varying,
    email character varying(100) DEFAULT NULL::character varying,
    activo character varying(1) DEFAULT NULL::character varying,
    observ character varying(255) DEFAULT NULL::character varying,
    coordenadas character varying(100) DEFAULT NULL::character varying,
    posicion integer,
    alias character varying(10)
);


ALTER TABLE public.regiones OWNER TO postgres;

--
-- Name: respeducacioncontinua; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.respeducacioncontinua (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    nropregunta numeric(2,0) NOT NULL,
    respuesta character varying(30),
    puntaje numeric(10,2)
);


ALTER TABLE public.respeducacioncontinua OWNER TO postgres;

--
-- Name: respuesta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.respuesta (
    idpregunta numeric(10,0) NOT NULL,
    item numeric(3,0) NOT NULL,
    descripcio character varying(200),
    correcta character varying(1),
    correctar character varying(100)
);


ALTER TABLE public.respuesta OWNER TO postgres;

--
-- Name: respuestafinal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.respuestafinal (
    codigo integer NOT NULL,
    nroeval numeric(10,0),
    idpregunta numeric(10,0),
    codusu character varying(20),
    respuesta character varying(1),
    respuestar character varying(200),
    enviado character varying(2) DEFAULT 'N'::character varying,
    fechaenviado date,
    metodo character varying(100),
    reactivo character varying(100),
    equipo character varying(100),
    marca character varying(100),
    lote character varying(100),
    fechaven date,
    obs character varying(100),
    puntaje numeric(10,2)
);


ALTER TABLE public.respuestafinal OWNER TO postgres;

--
-- Name: respuestaleishmania; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.respuestaleishmania (
    nroeval numeric(10,0),
    codusu character varying(20),
    codnumero character varying(2),
    codletra character varying(2),
    valor character varying(100),
    fechaenviado date,
    item numeric(5,0),
    puntaje numeric(10,2)
);


ALTER TABLE public.respuestaleishmania OWNER TO postgres;

--
-- Name: respuestaparti; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.respuestaparti (
    nroeval numeric(10,0),
    codestudio character varying(10),
    coddetermina character varying(10),
    codusu character varying(20),
    respuesta character varying(100),
    metodo character varying(100),
    reactivo character varying(100),
    equipo character varying(100),
    marcaeq character varying(100),
    lote character varying(100),
    marcalo character varying(100),
    fechaven date,
    fechaenviado date,
    puntaje numeric(10,1)
);


ALTER TABLE public.respuestaparti OWNER TO postgres;

--
-- Name: respuestaparticipante; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.respuestaparticipante (
    codigo integer NOT NULL,
    nroeval numeric(10,0),
    item numeric(3,0),
    codusu character varying(20),
    respuesta integer,
    enviado character varying(2) DEFAULT 'N'::character varying,
    fechaenviado date,
    metodo character varying(100),
    reactivo character varying(100),
    equipo character varying(100),
    marca character varying(100),
    lote character varying(100),
    fechaven date,
    obs character varying(100)
);


ALTER TABLE public.respuestaparticipante OWNER TO postgres;

--
-- Name: resulsifilis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resulsifilis (
    nroeval numeric(10,0) NOT NULL,
    codempresa character varying(20) NOT NULL,
    reactivo character varying(50) NOT NULL,
    nrotubo numeric(1,0) NOT NULL,
    esreactivo character varying(50),
    noesreactivo character varying(20),
    dilucion character varying(100),
    esreactivor character varying(50),
    noesreactivor character varying(20),
    dilucionr character varying(100),
    puntaje numeric(10,2)
);


ALTER TABLE public.resulsifilis OWNER TO postgres;

--
-- Name: resultadoantibiotico; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultadoantibiotico (
    nordentra integer NOT NULL,
    codservicio character varying(10) NOT NULL,
    nroestudio character varying(20) NOT NULL,
    idmuestra character varying(20) NOT NULL,
    nroresul numeric(10,0),
    fechares date,
    codmetodo character varying(10),
    codumedida character varying(10),
    codsector character varying(10),
    codestudio character varying(10),
    codantibiot character varying(10),
    diametro character varying(20),
    cmi character varying(100),
    resultado character varying(100),
    obs character varying(250)
);


ALTER TABLE public.resultadoantibiotico OWNER TO postgres;

--
-- Name: resultadocodificado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultadocodificado (
    codresultado character varying(10) NOT NULL,
    nomresultado character varying(1100)
);


ALTER TABLE public.resultadocodificado OWNER TO postgres;

--
-- Name: resultadocodificadobio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultadocodificadobio (
    codresultado character varying(10) NOT NULL,
    nomresultado character varying(250)
);


ALTER TABLE public.resultadocodificadobio OWNER TO postgres;

--
-- Name: resultadoequipo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultadoequipo (
    idmuestra character varying(20) NOT NULL,
    codequipo character varying(10),
    nomyape character varying(150),
    fecha date,
    hora character varying(8),
    codestudio character varying(10),
    coddetermina character varying(10),
    idasig1 character varying(20),
    idasig2 character varying(20),
    resultado character varying(100),
    nroanalisis character varying(20)
);


ALTER TABLE public.resultadoequipo OWNER TO postgres;

--
-- Name: resultadomicroorganismo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultadomicroorganismo (
    nordentra integer NOT NULL,
    codservicio character varying(10) NOT NULL,
    nroestudio character varying(20) NOT NULL,
    idmuestra character varying(20) NOT NULL,
    nroresul numeric(10,0),
    fechares date,
    codmetodo character varying(10),
    codumedida character varying(10),
    codsector character varying(10),
    codestudio character varying(10),
    codmicroorg character varying(10),
    resultado character varying(100),
    codantibiogr character varying(10),
    obs character varying(250),
    codestudiobio character varying(10)
);


ALTER TABLE public.resultadomicroorganismo OWNER TO postgres;

--
-- Name: resultadoposible; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultadoposible (
    codestudio character varying(10) NOT NULL,
    coddetermina character varying(10) NOT NULL,
    codresultado character varying(10) NOT NULL
);


ALTER TABLE public.resultadoposible OWNER TO postgres;

--
-- Name: resultadoposiblemaster; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultadoposiblemaster (
    coddetermina character varying(10) NOT NULL,
    codresultado character varying(10) NOT NULL
);


ALTER TABLE public.resultadoposiblemaster OWNER TO postgres;

--
-- Name: resultadorepeticion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultadorepeticion (
    nordentra integer NOT NULL,
    nroestudio character varying(20) NOT NULL,
    idmuestra character varying(20) NOT NULL,
    nroresul numeric(10,0) NOT NULL,
    fechares date,
    codmetodo character varying(10),
    codumedida character varying(10),
    codsector character varying(10),
    codestudio character varying(10),
    coddetermina character varying(10),
    resultado character varying(100),
    codresultado character varying(10),
    codequipo character varying(10),
    anulado numeric(1,0),
    fechaanul date,
    horaanul character varying(8),
    codusu character varying(20),
    obs character varying(250)
);


ALTER TABLE public.resultadorepeticion OWNER TO postgres;

--
-- Name: resultados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultados (
    nordentra integer NOT NULL,
    codservicio character varying(10) NOT NULL,
    nroestudio integer NOT NULL,
    idmuestra character varying(20) NOT NULL,
    nroorden numeric(10,0),
    fechares date,
    codmetodo character varying(10),
    codumedida character varying(10),
    codsector character varying(10),
    codestudio character varying(10),
    coddetermina character varying(10),
    resultado character varying(250),
    codresultado character varying(10),
    codequipo character varying(10),
    codestado character varying(5),
    codusu1 character varying(20),
    fechaval date,
    horaval character varying(8),
    codusu2 character varying(20),
    fechareval date,
    horareval character varying(8),
    anulado numeric(1,0),
    fechaanul date,
    horaanul character varying(8),
    codusu3 character varying(20),
    codusu4 character varying(20),
    fechaent date,
    horaentre character varying(8),
    obs character varying(300),
    vecesimp numeric(3,0),
    codusu5 character varying(20),
    fechaenvio date,
    horaenvio numeric(8,0),
    nro_toma character varying(100),
    cod_dgvs bigint,
    envio_dgvs numeric(1,0),
    ffiebre character varying(10),
    ftoma character varying(10),
    orden_dgvs character varying(20),
    nroficha integer,
    idlab integer,
    id_secciones_ficha integer,
    proceso_dgvs character varying(50),
    cod_dgvs2 integer,
    cod_reactivo character(30),
    horares character(8),
    hospitalizado character varying(2),
    fallecido character varying(2),
    numero_muestra character varying(10)
);


ALTER TABLE public.resultados OWNER TO postgres;

--
-- Name: resultados_fusion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultados_fusion (
    id integer NOT NULL,
    idmaquina character varying(100) NOT NULL,
    fch date,
    hora character varying(10),
    nroorden integer,
    usuario character varying(100),
    machinename character varying(100),
    sampleid character varying(100),
    sampleidname character varying(100),
    catalogid character varying(75),
    catalogtype character varying(2),
    locustype character varying(50),
    trayid character varying(100),
    trayidname character varying(100),
    patientid character varying(50),
    wellid character varying(100),
    expr1 character varying(100),
    wellposition character varying(50),
    expr2 character varying(100),
    wellremarks character varying(10485760),
    rxn character varying(2000),
    beadcnt integer,
    nc1 real,
    nc1beadid character varying(4),
    nc2 real,
    nc2beadid character varying(4),
    pc1 real,
    pc1beadid character varying(4),
    pc2 real,
    pc2beadid character varying(4),
    moretest character varying(10),
    falserxn character varying(10),
    morehiresolution character varying(10),
    nmdpreportcreated character varying(10),
    nsflg character varying(10),
    cwincluded character varying(10),
    cl1formulaid character varying(10),
    cl2formulaid character varying(10),
    parentwellid character varying(100),
    wellstatus character(2),
    analysisuserid character varying(100),
    analysisdt timestamp without time zone,
    confirmuserid character varying(100),
    confirmdt timestamp without time zone,
    isactive character varying(10),
    deluserid character varying(100),
    deldt timestamp without time zone,
    mesfwellid character varying(50),
    configureid integer,
    imagefile character varying(256),
    excluded character varying(10),
    asigned_allele_code character varying(100),
    locus_1 character varying(100),
    nmdp_1 character varying(100),
    nmdp_id_1 character varying(100),
    nmdpdef_1 text,
    locus_2 character varying(100),
    nmdp_2 character varying(100),
    nmdp_id_2 character varying(100),
    nmdpdef_2 text,
    resultid character varying(100)
);


ALTER TABLE public.resultados_fusion OWNER TO postgres;

--
-- Name: resultados_fusion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.resultados_fusion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.resultados_fusion_id_seq OWNER TO postgres;

--
-- Name: resultados_fusion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.resultados_fusion_id_seq OWNED BY public.resultados_fusion.id;


--
-- Name: resultados_ingenius; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultados_ingenius (
    id integer NOT NULL,
    sender_name character varying(100),
    transmission_date character varying(100),
    sequence_id character varying(100),
    universal_test_id character varying(100),
    nro_orden character varying(100),
    nombre_paciente character varying(100),
    universal_test_id2 character varying(100),
    data_easured character varying(100),
    component1 character varying(100),
    component2 character varying(100),
    units character varying(100),
    result_flag character varying(100),
    operator_name character varying(100),
    completed_date_time character varying(100)
);


ALTER TABLE public.resultados_ingenius OWNER TO postgres;

--
-- Name: resultados_ingenius_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.resultados_ingenius_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.resultados_ingenius_id_seq OWNER TO postgres;

--
-- Name: resultados_ingenius_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.resultados_ingenius_id_seq OWNED BY public.resultados_ingenius.id;


--
-- Name: resultados_utype; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultados_utype (
    nro_orden integer NOT NULL,
    locus character varying(10) NOT NULL,
    tipificacion character varying(30),
    realizado_por character varying(30),
    confirmado_por character varying(30),
    nombre_equipo character varying(30)
);


ALTER TABLE public.resultados_utype OWNER TO postgres;

--
-- Name: resultadosmicro; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.resultadosmicro (
    nordentra integer NOT NULL,
    codservicio character varying(10) NOT NULL,
    nroestudio integer NOT NULL,
    idmuestra character varying(20) NOT NULL,
    norden numeric(5,0),
    fechares date,
    codmetodo character varying(10),
    codumedida character varying(10),
    codsector character varying(10),
    codestudio character varying(10),
    coddetermina character varying(10),
    resultado character varying(100),
    codresultado character varying(10),
    codequipo character varying(10),
    codestado character varying(5),
    codusu1 character varying(20),
    fechaval date,
    horaval character varying(8),
    codusu2 character varying(20),
    fechareval date,
    horareval character varying(8),
    anulado numeric(1,0),
    fechaanul date,
    horaanul character varying(8),
    codusu3 character varying(20),
    codusu4 character varying(20),
    fechaent date,
    horaentre numeric(8,0),
    obs character varying(250),
    vecesimp numeric(3,0),
    envio_dgvs numeric(1,0)
);


ALTER TABLE public.resultadosmicro OWNER TO postgres;

--
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    codrol character varying(10) NOT NULL,
    nomrol character varying(100),
    estado numeric(1,0)
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- Name: rubeolacong; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rubeolacong (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    fechacons date,
    fechacap date,
    fechanotif date,
    nomyapenot character varying(150),
    telefononot character varying(30),
    celularnot character varying(30),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3),
    subsector numeric(1,0),
    subsectoresp character varying(150),
    conocio numeric(1,0),
    conociootr character varying(150),
    cedula character varying(15),
    nomyape character varying(150),
    fechanac date,
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    nacionalidad character varying(100),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    dccion character varying(200),
    referencia character varying(200),
    telefonor character varying(30),
    celularr character varying(30),
    tipoloc numeric(1,0),
    esetnia numeric(1,0),
    codetnia character varying(5),
    nommadre character varying(150),
    cedulamadre character varying(15),
    edadmad numeric(3,0),
    escolaridad numeric(1,0),
    ocupacion character varying(150),
    dcciontra character varying(200),
    ftevac numeric(1,0),
    tipovac numeric(1,0),
    ndosis character varying(30),
    fecvac1ra date,
    fecvacref date,
    fecvacadic date,
    codregvac character varying(2),
    coddistvac character varying(3),
    codservvac character varying(3),
    hospitaliza numeric(1,0),
    codreghos character varying(2),
    coddisthos character varying(3),
    codservhos character varying(3),
    fechadmin date,
    diasinter numeric(3,0),
    nrohclinica character varying(20),
    tipoalta numeric(1,0),
    altadesc character varying(200),
    fecalta date,
    defuncion numeric(1,0),
    codregdef character varying(2),
    coddistdef character varying(3),
    codservdef character varying(3),
    fecdefun date,
    defcausa character varying(200),
    rubeolaconf numeric(1,0),
    casonro1 character varying(20),
    edadgest1 numeric(2,0),
    efenoinv numeric(1,0),
    exprubeola numeric(1,0),
    casonro2 character varying(20),
    edadgest2 numeric(2,0),
    expdonde2 character varying(200),
    expprubeola numeric(1,0),
    casonro3 character varying(20),
    edadgest3 numeric(2,0),
    expdonde3 character varying(200),
    viajea character varying(200),
    edadgest4 numeric(2,0),
    fecviaje date,
    contactviaje character varying(100),
    edadgest5 numeric(2,0),
    feccontact date,
    embaprev numeric(2,0),
    partoprev numeric(2,0),
    ctrlprenat numeric(1,0),
    nroctrl numeric(2,0),
    codregcrtl character varying(2),
    coddistctrl character varying(3),
    codservctrl character varying(3),
    fecfum date,
    fecpp date,
    edadgestact numeric(2,0),
    finembar numeric(1,0),
    finemba numeric(1,0),
    lugarnac numeric(1,0),
    hospitaliza2 numeric(1,0),
    codreghosm character varying(2),
    coddisthosm character varying(3),
    codservhosm character varying(3),
    fecadmin date,
    diasinter2 numeric(3,0),
    nrohclinica2 character varying(20),
    tipoalta2 numeric(1,0),
    clasifinal numeric(1,0),
    fecfinal date,
    confirmapor numeric(1,0),
    descartado numeric(1,0)
);


ALTER TABLE public.rubeolacong OWNER TO postgres;

--
-- Name: sectores; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sectores (
    codsector character varying(10) NOT NULL,
    nomsector character varying(200),
    posicion numeric(5,0)
);


ALTER TABLE public.sectores OWNER TO postgres;

--
-- Name: semana_epidemiologica; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.semana_epidemiologica (
    codsemana integer NOT NULL,
    numero_semana integer NOT NULL,
    mes character varying NOT NULL,
    desde date NOT NULL,
    hasta date NOT NULL,
    anhio character varying NOT NULL
);


ALTER TABLE public.semana_epidemiologica OWNER TO postgres;

--
-- Name: semana_epidemiologica_codsemana_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.semana_epidemiologica_codsemana_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.semana_epidemiologica_codsemana_seq OWNER TO postgres;

--
-- Name: semana_epidemiologica_codsemana_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.semana_epidemiologica_codsemana_seq OWNED BY public.semana_epidemiologica.codsemana;


--
-- Name: semanas_anuales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.semanas_anuales (
    semana integer DEFAULT 0,
    fechadesde character varying(10) DEFAULT NULL::character varying,
    fechahasta character varying(10) DEFAULT NULL::character varying,
    "año" character varying(4) DEFAULT NULL::character varying,
    aanio character varying(4) DEFAULT NULL::character varying
);


ALTER TABLE public.semanas_anuales OWNER TO postgres;

--
-- Name: seq_estrealizar; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_estrealizar
    START WITH 159923
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_estrealizar OWNER TO postgres;

--
-- Name: seq_respuesta; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_respuesta
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_respuesta OWNER TO postgres;

--
-- Name: seq_respuestar; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_respuestar
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_respuestar OWNER TO postgres;

--
-- Name: sintomas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sintomas (
    codsintoma character varying(10) NOT NULL,
    tipo numeric(1,0) NOT NULL,
    nomsintoma character varying(100)
);


ALTER TABLE public.sintomas OWNER TO postgres;

--
-- Name: sintomasnob; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sintomasnob (
    nronotif numeric(10,0) NOT NULL,
    codsintoma character varying(10) NOT NULL,
    otroesp character varying(200),
    tipo numeric(1,0) NOT NULL
);


ALTER TABLE public.sintomasnob OWNER TO postgres;

--
-- Name: textos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.textos (
    codtexto numeric(10,0) NOT NULL,
    nomtexto character varying(100),
    texto character varying(250)
);


ALTER TABLE public.textos OWNER TO postgres;

--
-- Name: textosestudios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.textosestudios (
    codestudio character varying(10) NOT NULL,
    codtexto numeric(10,0) NOT NULL,
    tipo numeric(1,0)
);


ALTER TABLE public.textosestudios OWNER TO postgres;

--
-- Name: tipomuestra; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipomuestra (
    codtmuestra character varying(10) NOT NULL,
    nomtmuestra character varying(100)
);


ALTER TABLE public.tipomuestra OWNER TO postgres;

--
-- Name: tiporangoedad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tiporangoedad (
    cgrupoedad character varying(10) NOT NULL,
    ngrupoedad character varying(100)
);


ALTER TABLE public.tiporangoedad OWNER TO postgres;

--
-- Name: tiposturnos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tiposturnos (
    codservicio character varying(10) NOT NULL,
    codarea character varying(10) NOT NULL,
    codturno numeric(10,0) NOT NULL,
    cantlun numeric(2,0),
    cantmar numeric(2,0),
    cantmie numeric(2,0),
    cantjue numeric(2,0),
    cantvie numeric(2,0),
    cantsab numeric(2,0),
    cantdom numeric(2,0),
    horarlun character varying(50),
    horarmar character varying(50),
    horarmie character varying(50),
    horarjue character varying(50),
    horarvie character varying(50),
    horarsab character varying(50),
    horardom character varying(50),
    nomturno character varying(100)
);


ALTER TABLE public.tiposturnos OWNER TO postgres;

--
-- Name: tmuestraestudio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tmuestraestudio (
    codestudio character varying(10) NOT NULL,
    codtmuestra character varying(10) NOT NULL,
    posicion numeric(3,0)
);


ALTER TABLE public.tmuestraestudio OWNER TO postgres;

--
-- Name: toscoquetos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.toscoquetos (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3),
    fechacap date,
    tdocumento numeric(1,0),
    cedula character varying(15),
    nrosemana numeric(2,0),
    nropsemanal numeric(10,0),
    responsable character varying(150),
    fechanotif date,
    pnombre character varying(30),
    snombre character varying(30),
    papellido character varying(30),
    sapellido character varying(30),
    apellidocas character varying(30),
    nrohclinica character varying(10),
    sexo numeric(1,0),
    fechanac date,
    edad numeric(3,0),
    coddptor character varying(2),
    coddistr character varying(3),
    tipoarear numeric(1,0),
    codbarrior character varying(3),
    otrobarrior character varying(100),
    referenciar character varying(250),
    dccionr character varying(200),
    telefonor character varying(30),
    conocio numeric(1,0),
    codocup character varying(10),
    ocupacion character varying(100),
    nomadre character varying(150),
    carnetvac numeric(1,0),
    pentavalente numeric(1,0),
    penta1ra date,
    penta2da date,
    penta3ra date,
    penta1erref date,
    penta2doref date,
    vacdpt numeric(1,0),
    dpt1ra date,
    dpt2da date,
    dpt3ra date,
    dpt1erref date,
    dpt2doref date,
    codregva character varying(2),
    subcregva character varying(3),
    coddistva character varying(3),
    codservva character varying(3),
    fiebre numeric(1,0),
    vomitos numeric(1,0),
    cianosis numeric(1,0),
    apnea numeric(1,0),
    estridor numeric(1,0),
    hemsubconj numeric(1,0),
    neumonia numeric(1,0),
    encefalopatia numeric(1,0),
    broquiectasias numeric(1,0),
    otitismedia numeric(1,0),
    hemitracereb numeric(1,0),
    comotras numeric(1,0),
    comptrasesp character varying(100),
    tos12 numeric(1,0),
    tos36 numeric(1,0),
    tos78 numeric(1,0),
    catarro12 numeric(1,0),
    paroxistico36 numeric(1,0),
    convales78 numeric(1,0),
    hospitaliza numeric(1,0),
    codreghos character varying(2),
    subcreghos character varying(3),
    coddisthos character varying(3),
    codservhos character varying(3),
    tratmedica character varying(150),
    tratdosis character varying(50),
    tratfec date,
    defuncion numeric(1,0),
    lugardef character varying(100),
    fechadef date,
    certifdef character varying(10),
    globrojo character varying(30),
    globblanco character varying(30),
    linfocitos character varying(30),
    neutrofilos character varying(30),
    fteinfecc character varying(100),
    contconfirm numeric(1,0),
    contsospec numeric(1,0),
    viajo20d numeric(1,0),
    viajo20dfec date,
    viajo20pais character varying(5),
    viajo20ddpto character varying(2),
    ciajo20ddist character varying(3),
    antibiotprev numeric(1,0),
    antibiotutil character varying(100),
    tomamtra date,
    lcforma numeric(1,0),
    lcrecibefec date,
    aislaborde numeric(1,0),
    resulfec date,
    clasfinalfec date,
    clasfinal numeric(1,0)
);


ALTER TABLE public.toscoquetos OWNER TO postgres;

--
-- Name: turnos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.turnos (
    nroturno character varying(10) NOT NULL,
    codservicio character varying(10) NOT NULL,
    codarea character varying(10),
    nropaciente numeric(10,0),
    fechatur date,
    horatur character varying(8),
    urgente numeric(1,0),
    asistio numeric(1,0),
    reasignado numeric(1,0),
    nroturreas character varying(10),
    suspendido numeric(1,0),
    obs character varying(250),
    codturno numeric(10,0)
);


ALTER TABLE public.turnos OWNER TO postgres;

--
-- Name: unidadmedida; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.unidadmedida (
    codumedida character varying(10) NOT NULL,
    nomumedida character varying(50)
);


ALTER TABLE public.unidadmedida OWNER TO postgres;

--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    codusu character varying(20) NOT NULL,
    nomyape character varying(150),
    cedula character varying(15),
    email character varying(50),
    telefono character varying(30),
    celular character varying(30),
    dccion character varying(200),
    fechareg date,
    estado numeric(1,0),
    clave character varying(20),
    fechauact date,
    codservicio character varying(10),
    codarea character varying(10),
    recsms numeric(1,0),
    recemail numeric(1,0),
    recalerta numeric(1,0),
    nroregprof character varying(30),
    codempresa character varying(10),
    laboratorio bigint
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: usuariosareas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuariosareas (
    codusu character varying(20) NOT NULL,
    codservicio character varying(10) NOT NULL,
    codarea character varying(10) NOT NULL,
    codrol character varying(10) NOT NULL,
    estado numeric(1,0),
    sms numeric(1,0),
    email numeric(1,0),
    alerta numeric(1,0),
    fechauact date
);


ALTER TABLE public.usuariosareas OWNER TO postgres;

--
-- Name: varicela; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.varicela (
    nronotif numeric(10,0) NOT NULL,
    nordentra character varying(20),
    fechacons date,
    fechacap date,
    fechanotif date,
    nomyapenot character varying(150),
    telefononot character varying(30),
    celularnot character varying(30),
    codreg character varying(2),
    subcreg character varying(3),
    coddist character varying(3),
    codserv character varying(3),
    subsector numeric(1,0),
    subsectoresp character varying(150),
    conocio numeric(1,0),
    conociootr character varying(150),
    cedula character varying(15),
    nomyape character varying(150),
    fechanac date,
    edada numeric(3,0),
    edadm numeric(3,0),
    edadd numeric(3,0),
    sexo numeric(1,0),
    nacionalidad character varying(100),
    coddptor character varying(2),
    coddistr character varying(3),
    barrio character varying(100),
    dccion character varying(200),
    referencia character varying(200),
    telefonor character varying(30),
    celularr character varying(30),
    tipoloc numeric(1,0),
    esetnia numeric(1,0),
    codetnia character varying(5),
    ocupacion character varying(150),
    dcciontraesc character varying(200),
    nommadre character varying(150),
    cedulamadre character varying(15),
    vacfte numeric(1,0),
    vacvaricela numeric(1,0),
    fvac1ra date,
    fvacadicion date,
    codregvac character varying(2),
    coddistvac character varying(3),
    codservvac character varying(3),
    fecvisit date,
    temperat character varying(30),
    finifieb date,
    fiebredura numeric(2,0),
    finierup date,
    tipoerup numeric(1,0),
    hoapitaliza numeric(1,0),
    codreghos character varying(2),
    coddisthos character varying(3),
    codservhos character varying(3),
    fadmin date,
    diasinter numeric(3,0),
    nrohclinica character varying(20),
    tipoalta numeric(1,0),
    altadesc character varying(200),
    falta date,
    tratamiento numeric(1,0),
    tratcualig character varying(200),
    tratdoasis character varying(100),
    tratfec date,
    tratotr character varying(200),
    tratotrdos character varying(100),
    tratfecotr date,
    defuncion numeric(1,0),
    codregdef character varying(2),
    coddistdef character varying(3),
    codservdef character varying(3),
    fecdefun date,
    defcausa character varying(200),
    confirm1021 numeric(1,0),
    feccontacto date,
    casovaricela numeric(1,0),
    feccaso date,
    viajo1021 numeric(1,0),
    dondeviajo character varying(200),
    fecviaje date,
    contmujer numeric(1,0),
    seguim21 character varying(200),
    fecsegdesde date,
    fecseghasta date,
    clasfinal numeric(1,0),
    fecfinal date
);


ALTER TABLE public.varicela OWNER TO postgres;

--
-- Name: monitoreo codmonitoreo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.monitoreo ALTER COLUMN codmonitoreo SET DEFAULT nextval('public.monitoreo_codmonitoreo_seq'::regclass);


--
-- Name: resultados_fusion id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultados_fusion ALTER COLUMN id SET DEFAULT nextval('public.resultados_fusion_id_seq'::regclass);


--
-- Name: resultados_ingenius id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultados_ingenius ALTER COLUMN id SET DEFAULT nextval('public.resultados_ingenius_id_seq'::regclass);


--
-- Name: semana_epidemiologica codsemana; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.semana_epidemiologica ALTER COLUMN codsemana SET DEFAULT nextval('public.semana_epidemiologica_codsemana_seq'::regclass);


--
-- Name: departamentos departamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (coddpto);


--
-- Name: distritos distritos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.distritos
    ADD CONSTRAINT distritos_pkey PRIMARY KEY (coddpto, coddist);


--
-- Name: resultados_fusion idx_result_fusion_resu_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultados_fusion
    ADD CONSTRAINT idx_result_fusion_resu_id UNIQUE (resultid);


--
-- Name: monitoreo monitoreo_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.monitoreo
    ADD CONSTRAINT monitoreo_pk PRIMARY KEY (codmonitoreo);


--
-- Name: alertas pk_alertas; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alertas
    ADD CONSTRAINT pk_alertas PRIMARY KEY (nromsg);


--
-- Name: antibiogramas pk_antibiogramas; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.antibiogramas
    ADD CONSTRAINT pk_antibiogramas PRIMARY KEY (codantibiogr);


--
-- Name: antibioticoantibiograma pk_antibioticoantibiograma; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.antibioticoantibiograma
    ADD CONSTRAINT pk_antibioticoantibiograma PRIMARY KEY (codantibiogr, codantibiot);


--
-- Name: antibioticos pk_antibioticos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.antibioticos
    ADD CONSTRAINT pk_antibioticos PRIMARY KEY (codantibiot);


--
-- Name: anuncios pk_anuncios; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.anuncios
    ADD CONSTRAINT pk_anuncios PRIMARY KEY (norden);


--
-- Name: apertura_cierre_caja pk_apertura_cierre_caja; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.apertura_cierre_caja
    ADD CONSTRAINT pk_apertura_cierre_caja PRIMARY KEY (id);


--
-- Name: aranceles pk_aranceles; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aranceles
    ADD CONSTRAINT pk_aranceles PRIMARY KEY (codarancel);


--
-- Name: areasest pk_areasest; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.areasest
    ADD CONSTRAINT pk_areasest PRIMARY KEY (codservicio, codarea);


--
-- Name: arqueo pk_arqueo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.arqueo
    ADD CONSTRAINT pk_arqueo PRIMARY KEY (fecha, hora);


--
-- Name: bancos pk_bancos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bancos
    ADD CONSTRAINT pk_bancos PRIMARY KEY (codbco);


--
-- Name: bolutismo pk_bolutismo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bolutismo
    ADD CONSTRAINT pk_bolutismo PRIMARY KEY (nronotif);


--
-- Name: cajas pk_cajas; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cajas
    ADD CONSTRAINT pk_cajas PRIMARY KEY (codservicio, codcaja);


--
-- Name: carbunco_antrax pk_carbunco_antrax; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carbunco_antrax
    ADD CONSTRAINT pk_carbunco_antrax PRIMARY KEY (nronotif);


--
-- Name: chagas pk_chagas; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chagas
    ADD CONSTRAINT pk_chagas PRIMARY KEY (nronotif);


--
-- Name: colera pk_colera; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.colera
    ADD CONSTRAINT pk_colera PRIMARY KEY (nronotif);


--
-- Name: config_gral pk_config_gral; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.config_gral
    ADD CONSTRAINT pk_config_gral PRIMARY KEY (codservicio);


--
-- Name: contrasenias pk_contrasenias; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contrasenias
    ADD CONSTRAINT pk_contrasenias PRIMARY KEY (codusu, fecha, hora);


--
-- Name: courier pk_courier; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courier
    ADD CONSTRAINT pk_courier PRIMARY KEY (codcourier);


--
-- Name: creut_jakob pk_creut_jakob; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.creut_jakob
    ADD CONSTRAINT pk_creut_jakob PRIMARY KEY (nronotif);


--
-- Name: datoagrupado pk_datoagrupado; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.datoagrupado
    ADD CONSTRAINT pk_datoagrupado PRIMARY KEY (grupo, nordentra, codservicio, nromuestra);


--
-- Name: determinacionequipo pk_determinacionequipo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.determinacionequipo
    ADD CONSTRAINT pk_determinacionequipo PRIMARY KEY (codestudio, coddetermina, codequipo, codmetodo);


--
-- Name: determinacionesmaster pk_determinacionesmaster; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.determinacionesmaster
    ADD CONSTRAINT pk_determinacionesmaster PRIMARY KEY (coddetermina);


--
-- Name: determinacionrango pk_determinacionrango; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.determinacionrango
    ADD CONSTRAINT pk_determinacionrango PRIMARY KEY (codestudio, coddetermina, tipo);


--
-- Name: determinacionrangomaster pk_determinacionrangomaster; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.determinacionrangomaster
    ADD CONSTRAINT pk_determinacionrangomaster PRIMARY KEY (coddetermina, tipo);


--
-- Name: diagnostico pk_diagnostico; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.diagnostico
    ADD CONSTRAINT pk_diagnostico PRIMARY KEY (coddiagnostico);


--
-- Name: difteria pk_difteria; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.difteria
    ADD CONSTRAINT pk_difteria PRIMARY KEY (nronotif);


--
-- Name: emicrobiologia pk_emicrobiologia; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emicrobiologia
    ADD CONSTRAINT pk_emicrobiologia PRIMARY KEY (codestudiobio);


--
-- Name: empresas pk_empresas; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.empresas
    ADD CONSTRAINT pk_empresas PRIMARY KEY (codempresa);


--
-- Name: enfermedades pk_enfermedades; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enfermedades
    ADD CONSTRAINT pk_enfermedades PRIMARY KEY (codenferm);


--
-- Name: enfsintomas pk_enfsintomas; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enfsintomas
    ADD CONSTRAINT pk_enfsintomas PRIMARY KEY (codenferm, norden);


--
-- Name: equipos pk_equipos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.equipos
    ADD CONSTRAINT pk_equipos PRIMARY KEY (codequipo);


--
-- Name: establecimientos pk_establecimientos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.establecimientos
    ADD CONSTRAINT pk_establecimientos PRIMARY KEY (codservicio);


--
-- Name: estadoresultado pk_estadoresultado; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estadoresultado
    ADD CONSTRAINT pk_estadoresultado PRIMARY KEY (codestado);


--
-- Name: estrealizar pk_estrealizar; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estrealizar
    ADD CONSTRAINT pk_estrealizar PRIMARY KEY (nroestudio);


--
-- Name: estudios pk_estudios; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estudios
    ADD CONSTRAINT pk_estudios PRIMARY KEY (codestudio);


--
-- Name: eta pk_eta; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.eta
    ADD CONSTRAINT pk_eta PRIMARY KEY (nronotif);


--
-- Name: etaantecend pk_etaantecend; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etaantecend
    ADD CONSTRAINT pk_etaantecend PRIMARY KEY (nronotif, ocasion, alimentoing, hora);


--
-- Name: etiirag pk_etiirag; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etiirag
    ADD CONSTRAINT pk_etiirag PRIMARY KEY (nronotif);


--
-- Name: evalanalitos pk_evalanalitos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evalanalitos
    ADD CONSTRAINT pk_evalanalitos PRIMARY KEY (nroeval, codempresa, analito);


--
-- Name: evalbioquimica pk_evalbioquimica; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evalbioquimica
    ADD CONSTRAINT pk_evalbioquimica PRIMARY KEY (nroeval, codempresa);


--
-- Name: evaldengue pk_evaldengue; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evaldengue
    ADD CONSTRAINT pk_evaldengue PRIMARY KEY (nroeval, codempresa);


--
-- Name: evaleducacioncontinua pk_evaleducacioncontinua; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evaleducacioncontinua
    ADD CONSTRAINT pk_evaleducacioncontinua PRIMARY KEY (nroeval, codempresa);


--
-- Name: evalhematologia pk_evalhematologia; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evalhematologia
    ADD CONSTRAINT pk_evalhematologia PRIMARY KEY (nroeval, codempresa);


--
-- Name: evalinfluenza pk_evalinfluenza; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evalinfluenza
    ADD CONSTRAINT pk_evalinfluenza PRIMARY KEY (nroeval, codempresa);


--
-- Name: evalmalaria pk_evalmalaria; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evalmalaria
    ADD CONSTRAINT pk_evalmalaria PRIMARY KEY (nroeval, codempresa);


--
-- Name: evalpintestinal pk_evalpintestinal; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evalpintestinal
    ADD CONSTRAINT pk_evalpintestinal PRIMARY KEY (nroeval, codempresa);


--
-- Name: evalrotavirus pk_evalrotavirus; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evalrotavirus
    ADD CONSTRAINT pk_evalrotavirus PRIMARY KEY (nroeval, codempresa);


--
-- Name: evalsifilis pk_evalsifilis; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evalsifilis
    ADD CONSTRAINT pk_evalsifilis PRIMARY KEY (nroeval, codempresa);


--
-- Name: evaluaciondeterminacion pk_evaluaciondeterminacion; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evaluaciondeterminacion
    ADD CONSTRAINT pk_evaluaciondeterminacion PRIMARY KEY (nroeval, codestudio, coddetermina);


--
-- Name: evaluaciondetestu pk_evaluaciondetestu; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evaluaciondetestu
    ADD CONSTRAINT pk_evaluaciondetestu PRIMARY KEY (nroeval, codestudio);


--
-- Name: evaluacion pk_evalucion; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evaluacion
    ADD CONSTRAINT pk_evalucion PRIMARY KEY (nroeval);


--
-- Name: evaluaciondet pk_evaluciondet; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evaluaciondet
    ADD CONSTRAINT pk_evaluciondet PRIMARY KEY (nroeval, item);


--
-- Name: evalucionparticipante pk_evalucionparticipante; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.evalucionparticipante
    ADD CONSTRAINT pk_evalucionparticipante PRIMARY KEY (nroeval, item);


--
-- Name: febrilagudo pk_febrilagudo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.febrilagudo
    ADD CONSTRAINT pk_febrilagudo PRIMARY KEY (nronotif);


--
-- Name: febriles pk_febriles; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.febriles
    ADD CONSTRAINT pk_febriles PRIMARY KEY (nronotif);


--
-- Name: feriados pk_feriados; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.feriados
    ADD CONSTRAINT pk_feriados PRIMARY KEY (nroorden);


--
-- Name: hepatitisae pk_hepatitisae; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.hepatitisae
    ADD CONSTRAINT pk_hepatitisae PRIMARY KEY (nronotif);


--
-- Name: hepatitisbcd pk_hepatitisbcd; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.hepatitisbcd
    ADD CONSTRAINT pk_hepatitisbcd PRIMARY KEY (nronotif);


--
-- Name: histocompatibilidad1 pk_histocompatibilida1; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.histocompatibilidad1
    ADD CONSTRAINT pk_histocompatibilida1 PRIMARY KEY (nronotif);


--
-- Name: histocompatibilidad2 pk_histocompatibilidad2; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.histocompatibilidad2
    ADD CONSTRAINT pk_histocompatibilidad2 PRIMARY KEY (nronotif);


--
-- Name: histocompatibilidad3 pk_histocompatibilidad3; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.histocompatibilidad3
    ADD CONSTRAINT pk_histocompatibilidad3 PRIMARY KEY (nronotif);


--
-- Name: homebanking pk_homebanking; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.homebanking
    ADD CONSTRAINT pk_homebanking PRIMARY KEY (nroingreso);


--
-- Name: ingresocaja pk_ingresocaja; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ingresocaja
    ADD CONSTRAINT pk_ingresocaja PRIMARY KEY (nroingreso);


--
-- Name: iraginusitada pk_iraginusitada; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.iraginusitada
    ADD CONSTRAINT pk_iraginusitada PRIMARY KEY (nronotif);


--
-- Name: labdifteria pk_labdifteria; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.labdifteria
    ADD CONSTRAINT pk_labdifteria PRIMARY KEY (nronotif, nromuestra);


--
-- Name: labparalisisav pk_labparalisisav; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.labparalisisav
    ADD CONSTRAINT pk_labparalisisav PRIMARY KEY (nronotif, nromuestra);


--
-- Name: labparalisisitd pk_labparalisisitd; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.labparalisisitd
    ADD CONSTRAINT pk_labparalisisitd PRIMARY KEY (nronotif, nromuestra);


--
-- Name: labrubeola pk_labrubeola; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.labrubeola
    ADD CONSTRAINT pk_labrubeola PRIMARY KEY (nronotif, nromuestra);


--
-- Name: labvaricela pk_labvaricela; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.labvaricela
    ADD CONSTRAINT pk_labvaricela PRIMARY KEY (nronotif, nromuestra);


--
-- Name: lamimalaria pk_lamimalaria; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lamimalaria
    ADD CONSTRAINT pk_lamimalaria PRIMARY KEY (nroeval, codempresa, norden);


--
-- Name: leishmaniosismucosa pk_leishmaniosismucosa; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leishmaniosismucosa
    ADD CONSTRAINT pk_leishmaniosismucosa PRIMARY KEY (nronotif);


--
-- Name: leishmaniosisvh pk_leishmaniosisvh; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leishmaniosisvh
    ADD CONSTRAINT pk_leishmaniosisvh PRIMARY KEY (nronotif);


--
-- Name: malaria pk_malaria; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.malaria
    ADD CONSTRAINT pk_malaria PRIMARY KEY (nronotif);


--
-- Name: matdengue pk_matdengue; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.matdengue
    ADD CONSTRAINT pk_matdengue PRIMARY KEY (nroeval, codempresa, nromuestra);


--
-- Name: matinfluenza pk_matinfluenza; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.matinfluenza
    ADD CONSTRAINT pk_matinfluenza PRIMARY KEY (nroeval, codempresa, nrolamina);


--
-- Name: matrotavirus pk_matrotavirus; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.matrotavirus
    ADD CONSTRAINT pk_matrotavirus PRIMARY KEY (nroeval, codempresa, nromuestra);


--
-- Name: medicos pk_medicos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.medicos
    ADD CONSTRAINT pk_medicos PRIMARY KEY (codmedico);


--
-- Name: meningitis pk_meningitis; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.meningitis
    ADD CONSTRAINT pk_meningitis PRIMARY KEY (nronotif);


--
-- Name: mensajes pk_mensajes; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mensajes
    ADD CONSTRAINT pk_mensajes PRIMARY KEY (nromsg, fecha, hora, codusu, codservicio);


--
-- Name: metodos pk_metodos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.metodos
    ADD CONSTRAINT pk_metodos PRIMARY KEY (codmetodo);


--
-- Name: microorganismos pk_microorganismos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.microorganismos
    ADD CONSTRAINT pk_microorganismos PRIMARY KEY (codmicroorg);


--
-- Name: motivoanulacion pk_motivoanulacion; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.motivoanulacion
    ADD CONSTRAINT pk_motivoanulacion PRIMARY KEY (codanula);


--
-- Name: motivorechazo pk_motivorechazo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.motivorechazo
    ADD CONSTRAINT pk_motivorechazo PRIMARY KEY (codrechazo);


--
-- Name: nobligatorias pk_nobligatorias; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nobligatorias
    ADD CONSTRAINT pk_nobligatorias PRIMARY KEY (nronotif);


--
-- Name: ordtrabajo pk_nordentra; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ordtrabajo
    ADD CONSTRAINT pk_nordentra PRIMARY KEY (nordentra);


--
-- Name: notifmalaria pk_notifmalaria; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notifmalaria
    ADD CONSTRAINT pk_notifmalaria PRIMARY KEY (nronotif, codempresa, nrocontrol);


--
-- Name: opciones pk_opciones; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.opciones
    ADD CONSTRAINT pk_opciones PRIMARY KEY (codopc);


--
-- Name: opcionroles pk_opcionroles; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.opcionroles
    ADD CONSTRAINT pk_opcionroles PRIMARY KEY (codrol, codopc);


--
-- Name: ordenagrupado pk_ordenagrupado; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ordenagrupado
    ADD CONSTRAINT pk_ordenagrupado PRIMARY KEY (grupo, nordentra, codestudio);


--
-- Name: origenpaciente pk_origenpaciente; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.origenpaciente
    ADD CONSTRAINT pk_origenpaciente PRIMARY KEY (codorigen);


--
-- Name: otreventos pk_otreventos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.otreventos
    ADD CONSTRAINT pk_otreventos PRIMARY KEY (nronotif);


--
-- Name: paciente pk_paciente; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.paciente
    ADD CONSTRAINT pk_paciente PRIMARY KEY (nropaciente);


--
-- Name: paciente_mal pk_paciente_mal; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.paciente_mal
    ADD CONSTRAINT pk_paciente_mal PRIMARY KEY (nropaciente);


--
-- Name: paralisisfla pk_paralisisfla; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.paralisisfla
    ADD CONSTRAINT pk_paralisisfla PRIMARY KEY (nronotif);


--
-- Name: parotiditis pk_parotiditis; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.parotiditis
    ADD CONSTRAINT pk_parotiditis PRIMARY KEY (nronotif);


--
-- Name: perfiles pk_perfiles; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.perfiles
    ADD CONSTRAINT pk_perfiles PRIMARY KEY (codusu, codopc);


--
-- Name: plantillaplan pk_plantillaplan; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plantillaplan
    ADD CONSTRAINT pk_plantillaplan PRIMARY KEY (codplatilla);


--
-- Name: plantillaplandet pk_plantillaplandet; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plantillaplandet
    ADD CONSTRAINT pk_plantillaplandet PRIMARY KEY (codplatilla, posicion);


--
-- Name: plantrabajo pk_plantrabajo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plantrabajo
    ADD CONSTRAINT pk_plantrabajo PRIMARY KEY (nroplan, codservicio, codarea, codsector, fecha);


--
-- Name: pregunta pk_pregunta; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pregunta
    ADD CONSTRAINT pk_pregunta PRIMARY KEY (nroeval, idpregunta);


--
-- Name: preguntaedcontinua pk_preguntaedcontinua; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.preguntaedcontinua
    ADD CONSTRAINT pk_preguntaedcontinua PRIMARY KEY (nropregunta);


--
-- Name: procesoresultado pk_procesoresultado; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.procesoresultado
    ADD CONSTRAINT pk_procesoresultado PRIMARY KEY (nordentra, nroestudio, idmuestra);


--
-- Name: procesos pk_procesos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.procesos
    ADD CONSTRAINT pk_procesos PRIMARY KEY (codproceso);


--
-- Name: psitacosis pk_psitacosis; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.psitacosis
    ADD CONSTRAINT pk_psitacosis PRIMARY KEY (nronotif);


--
-- Name: rangoedad pk_rangoedad; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rangoedad
    ADD CONSTRAINT pk_rangoedad PRIMARY KEY (cgrupoedad, posicion);


--
-- Name: reactsifilis pk_reactsifilis; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reactsifilis
    ADD CONSTRAINT pk_reactsifilis PRIMARY KEY (nroeval, rectivo);


--
-- Name: rechazados pk_rechazados; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rechazados
    ADD CONSTRAINT pk_rechazados PRIMARY KEY (grupo, nromuestra);


--
-- Name: recibos pk_recibos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.recibos
    ADD CONSTRAINT pk_recibos PRIMARY KEY (nroingreso, norden);


--
-- Name: respeducacioncontinua pk_respeducacioncontinua; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.respeducacioncontinua
    ADD CONSTRAINT pk_respeducacioncontinua PRIMARY KEY (nroeval, codempresa, nropregunta);


--
-- Name: respuesta pk_respuesta; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.respuesta
    ADD CONSTRAINT pk_respuesta PRIMARY KEY (idpregunta, item);


--
-- Name: respuestafinal pk_respuestafinal; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.respuestafinal
    ADD CONSTRAINT pk_respuestafinal PRIMARY KEY (codigo);


--
-- Name: respuestaparticipante pk_respuestaparticipante; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.respuestaparticipante
    ADD CONSTRAINT pk_respuestaparticipante PRIMARY KEY (codigo);


--
-- Name: resulsifilis pk_resulsifilis; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resulsifilis
    ADD CONSTRAINT pk_resulsifilis PRIMARY KEY (nroeval, codempresa, reactivo, nrotubo);


--
-- Name: resultados_fusion pk_result_fusion_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultados_fusion
    ADD CONSTRAINT pk_result_fusion_id PRIMARY KEY (id);


--
-- Name: resultadoantibiotico pk_resultadoantibiotico; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultadoantibiotico
    ADD CONSTRAINT pk_resultadoantibiotico PRIMARY KEY (nordentra, codservicio, nroestudio, idmuestra);


--
-- Name: resultadocodificado pk_resultadocodificado; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultadocodificado
    ADD CONSTRAINT pk_resultadocodificado PRIMARY KEY (codresultado);


--
-- Name: resultadocodificadobio pk_resultadocodificadobio; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultadocodificadobio
    ADD CONSTRAINT pk_resultadocodificadobio PRIMARY KEY (codresultado);


--
-- Name: resultadoequipo pk_resultadoequipo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultadoequipo
    ADD CONSTRAINT pk_resultadoequipo PRIMARY KEY (idmuestra);


--
-- Name: resultadomicroorganismo pk_resultadomicroorganismo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultadomicroorganismo
    ADD CONSTRAINT pk_resultadomicroorganismo PRIMARY KEY (nordentra, codservicio, nroestudio, idmuestra);


--
-- Name: resultadoposible pk_resultadoposible; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultadoposible
    ADD CONSTRAINT pk_resultadoposible PRIMARY KEY (codestudio, coddetermina, codresultado);


--
-- Name: resultadoposiblemaster pk_resultadoposiblemaster; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultadoposiblemaster
    ADD CONSTRAINT pk_resultadoposiblemaster PRIMARY KEY (coddetermina, codresultado);


--
-- Name: resultadorepeticion pk_resultadorepeticion; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultadorepeticion
    ADD CONSTRAINT pk_resultadorepeticion PRIMARY KEY (nordentra, nroestudio, idmuestra, nroresul);


--
-- Name: resultados pk_resultados; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultados
    ADD CONSTRAINT pk_resultados PRIMARY KEY (nordentra, codservicio, nroestudio, idmuestra);


--
-- Name: resultadosmicro pk_resultadosmicro; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultadosmicro
    ADD CONSTRAINT pk_resultadosmicro PRIMARY KEY (nordentra, codservicio, nroestudio, idmuestra);


--
-- Name: roles pk_roles; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT pk_roles PRIMARY KEY (codrol);


--
-- Name: rubeolacong pk_rubeolacong; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rubeolacong
    ADD CONSTRAINT pk_rubeolacong PRIMARY KEY (nronotif);


--
-- Name: sectores pk_sectores; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sectores
    ADD CONSTRAINT pk_sectores PRIMARY KEY (codsector);


--
-- Name: sintomas pk_sintomas; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sintomas
    ADD CONSTRAINT pk_sintomas PRIMARY KEY (codsintoma, tipo);


--
-- Name: sintomasnob pk_sintomasnob; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sintomasnob
    ADD CONSTRAINT pk_sintomasnob PRIMARY KEY (nronotif, codsintoma, tipo);


--
-- Name: textos pk_textos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.textos
    ADD CONSTRAINT pk_textos PRIMARY KEY (codtexto);


--
-- Name: textosestudios pk_textosestudios; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.textosestudios
    ADD CONSTRAINT pk_textosestudios PRIMARY KEY (codestudio, codtexto);


--
-- Name: tipomuestra pk_tipomuestra; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipomuestra
    ADD CONSTRAINT pk_tipomuestra PRIMARY KEY (codtmuestra);


--
-- Name: tiporangoedad pk_tiporangoedad; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tiporangoedad
    ADD CONSTRAINT pk_tiporangoedad PRIMARY KEY (cgrupoedad);


--
-- Name: tiposturnos pk_tiposturnos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tiposturnos
    ADD CONSTRAINT pk_tiposturnos PRIMARY KEY (codservicio, codarea, codturno);


--
-- Name: tmuestraestudio pk_tmuestraestudio; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tmuestraestudio
    ADD CONSTRAINT pk_tmuestraestudio PRIMARY KEY (codestudio, codtmuestra);


--
-- Name: toscoquetos pk_toscoquetos; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.toscoquetos
    ADD CONSTRAINT pk_toscoquetos PRIMARY KEY (nronotif);


--
-- Name: turnos pk_turno; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.turnos
    ADD CONSTRAINT pk_turno PRIMARY KEY (nroturno, codservicio);


--
-- Name: unidadmedida pk_unidadmedida; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unidadmedida
    ADD CONSTRAINT pk_unidadmedida PRIMARY KEY (codumedida);


--
-- Name: usuarios pk_usuarios; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT pk_usuarios PRIMARY KEY (codusu);


--
-- Name: usuariosareas pk_usuariosareas; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuariosareas
    ADD CONSTRAINT pk_usuariosareas PRIMARY KEY (codusu, codservicio, codarea, codrol);


--
-- Name: resultados_utype pk_utype_code; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultados_utype
    ADD CONSTRAINT pk_utype_code PRIMARY KEY (nro_orden, locus);


--
-- Name: varicela pk_varicela; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.varicela
    ADD CONSTRAINT pk_varicela PRIMARY KEY (nronotif);


--
-- Name: regiones regiones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.regiones
    ADD CONSTRAINT regiones_pkey PRIMARY KEY (codreg, subcreg);


--
-- Name: resultados_ingenius resultados_ingenius_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.resultados_ingenius
    ADD CONSTRAINT resultados_ingenius_pk PRIMARY KEY (id);


--
-- Name: semana_epidemiologica semana_epidemiologica_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.semana_epidemiologica
    ADD CONSTRAINT semana_epidemiologica_pk PRIMARY KEY (codsemana);


--
-- Name: i_estrealizar; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX i_estrealizar ON public.estrealizar USING btree (nordentra, nropaciente, nroestudio);


--
-- Name: i_ordtrabajo; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX i_ordtrabajo ON public.ordtrabajo USING btree (nordentra, nropaciente);


--
-- Name: i_paciente; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX i_paciente ON public.paciente USING btree (nropaciente);


--
-- Name: i_paciente_mal; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX i_paciente_mal ON public.paciente_mal USING btree (nropaciente);


--
-- Name: ind_paciente; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX ind_paciente ON public.paciente USING btree (nropaciente DESC NULLS LAST, cedula, pnombre, papellido);


--
-- Name: ind_paciente_mal; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX ind_paciente_mal ON public.paciente_mal USING btree (nropaciente DESC NULLS LAST, cedula, pnombre, papellido);


--
-- Name: resultados_ingenius trg_rein_ai; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER trg_rein_ai AFTER INSERT ON public.resultados_ingenius FOR EACH ROW EXECUTE FUNCTION public.update_resultados_from_ingenius();


--
-- Name: determinaciones_equipos fk_dete_equipo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.determinaciones_equipos
    ADD CONSTRAINT fk_dete_equipo FOREIGN KEY (codequipo) REFERENCES public.equipos(codequipo);


--
-- PostgreSQL database dump complete
--

