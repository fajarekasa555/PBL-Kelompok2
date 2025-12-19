--
-- PostgreSQL database dump
--

-- Dumped from database version 15.3
-- Dumped by pg_dump version 17.0

-- Started on 2025-12-19 13:08:23

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2 (class 3079 OID 107680)
-- Name: pgcrypto; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;


--
-- TOC entry 3681 (class 0 OID 0)
-- Dependencies: 2
-- Name: EXTENSION pgcrypto; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pgcrypto IS 'cryptographic functions';


--
-- TOC entry 315 (class 1255 OID 156788)
-- Name: create_activity_with_members(character varying, text, character varying, date, character varying, json); Type: PROCEDURE; Schema: public; Owner: postgres
--

CREATE PROCEDURE public.create_activity_with_members(IN p_title character varying, IN p_description text, IN p_location character varying, IN p_date date, IN p_documentation character varying, IN p_members json)
    LANGUAGE plpgsql
    AS $$
DECLARE
    new_activity_id INT;
    item JSON;
BEGIN
    -- Insert activity
    INSERT INTO activities (title, description, location, date, documentation)
    VALUES (p_title, p_description, p_location, p_date, p_documentation)
    RETURNING id INTO new_activity_id;

    -- Insert members
    IF p_members IS NOT NULL THEN
        FOR item IN SELECT * FROM json_array_elements(p_members)
        LOOP
            INSERT INTO activity_members (activity_id, member_id, role)
            VALUES (
                new_activity_id,
                (item->>'member_id')::INT,
                (item->>'role')
            );
        END LOOP;
    END IF;

END;
$$;


ALTER PROCEDURE public.create_activity_with_members(IN p_title character varying, IN p_description text, IN p_location character varying, IN p_date date, IN p_documentation character varying, IN p_members json) OWNER TO postgres;

--
-- TOC entry 316 (class 1255 OID 156789)
-- Name: create_project_with_members(character varying, text, date, date, character varying, character varying, json); Type: PROCEDURE; Schema: public; Owner: postgres
--

CREATE PROCEDURE public.create_project_with_members(IN p_name character varying, IN p_description text, IN p_start_date date, IN p_end_date date, IN p_sponsor character varying, IN p_documentation character varying, IN p_members json)
    LANGUAGE plpgsql
    AS $$
DECLARE
    new_project_id INT;
    item JSON;
BEGIN
    INSERT INTO projects (name, description, start_date, end_date, sponsor, documentation)
    VALUES (p_name, p_description, p_start_date, p_end_date, p_sponsor, p_documentation)
    RETURNING id INTO new_project_id;

    FOR item IN SELECT * FROM json_array_elements(p_members)
    LOOP
        INSERT INTO project_members (project_id, member_id, role)
        VALUES (
            new_project_id,
            (item->>'member_id')::INT,
            item->>'role'
        );
    END LOOP;

END;
$$;


ALTER PROCEDURE public.create_project_with_members(IN p_name character varying, IN p_description text, IN p_start_date date, IN p_end_date date, IN p_sponsor character varying, IN p_documentation character varying, IN p_members json) OWNER TO postgres;

--
-- TOC entry 303 (class 1255 OID 156787)
-- Name: create_role(character varying); Type: PROCEDURE; Schema: public; Owner: postgres
--

CREATE PROCEDURE public.create_role(IN role_name character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    INSERT INTO roles (name) VALUES (role_name);
END;
$$;


ALTER PROCEDURE public.create_role(IN role_name character varying) OWNER TO postgres;

--
-- TOC entry 317 (class 1255 OID 164979)
-- Name: sp_insert_member_full(text, text, text, text, integer, text[], text[], text[], text[], text[], integer[], text[], text[], text[], text[], integer[]); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.sp_insert_member_full(p_nip text, p_name text, p_email text, p_phone text, p_jabatan_id integer, p_soc_platform text[], p_soc_username text[], p_soc_url text[], p_pend_jenjang text[], p_pend_institusi text[], p_pend_tahun_lulus integer[], p_matkul text[], p_semester text[], p_sertif_nama text[], p_sertif_penerbit text[], p_sertif_tahun integer[]) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    new_member_id INT;
    i INT;
BEGIN
    -- Insert member
    INSERT INTO members (nip, name, email, phone, jabatan_id, created_at)
    VALUES (p_nip, p_name, p_email, p_phone, p_jabatan_id, NOW())
    RETURNING id INTO new_member_id;

    ---------------------------------------
    -- Insert Sosial Media
    ---------------------------------------
    IF p_soc_platform IS NOT NULL THEN
        FOR i IN 1..array_length(p_soc_platform, 1) LOOP
            INSERT INTO member_social_media (member_id, platform, username, url)
            VALUES (
                new_member_id,
                p_soc_platform[i],
                p_soc_username[i],
                p_soc_url[i]
            );
        END LOOP;
    END IF;

    ---------------------------------------
    -- Insert Pendidikan
    ---------------------------------------
    IF p_pend_jenjang IS NOT NULL THEN
        FOR i IN 1..array_length(p_pend_jenjang, 1) LOOP
            INSERT INTO member_education (member_id, jenjang, institusi, tahun_lulus)
            VALUES (
                new_member_id,
                p_pend_jenjang[i],
                p_pend_institusi[i],
                p_pend_tahun_lulus[i]
            );
        END LOOP;
    END IF;

    ---------------------------------------
    -- Insert Mata Kuliah
    ---------------------------------------
    IF p_matkul IS NOT NULL THEN
        FOR i IN 1..array_length(p_matkul, 1) LOOP
            INSERT INTO member_courses (member_id, mata_kuliah, semester)
            VALUES (
                new_member_id,
                p_matkul[i],
                p_semester[i]
            );
        END LOOP;
    END IF;

    ---------------------------------------
    -- Insert Sertifikasi
    ---------------------------------------
    IF p_sertif_nama IS NOT NULL THEN
        FOR i IN 1..array_length(p_sertif_nama, 1) LOOP
            INSERT INTO member_certifications (member_id, nama_sertif, penerbit, tahun)
            VALUES (
                new_member_id,
                p_sertif_nama[i],
                p_sertif_penerbit[i],
                p_sertif_tahun[i]
            );
        END LOOP;
    END IF;

    RETURN new_member_id;
END;
$$;


ALTER FUNCTION public.sp_insert_member_full(p_nip text, p_name text, p_email text, p_phone text, p_jabatan_id integer, p_soc_platform text[], p_soc_username text[], p_soc_url text[], p_pend_jenjang text[], p_pend_institusi text[], p_pend_tahun_lulus integer[], p_matkul text[], p_semester text[], p_sertif_nama text[], p_sertif_penerbit text[], p_sertif_tahun integer[]) OWNER TO postgres;

--
-- TOC entry 318 (class 1255 OID 164980)
-- Name: sp_insert_member_full(text, text, text, text, text, text, text, text, text, text, text, text[], text[], text[], text[], text[], integer[], integer[], text[], text[], text[], text[], date[], date[], text[], text[]); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.sp_insert_member_full(p_nip text, p_nidn text, p_name text, p_title_prefix text, p_title_suffix text, p_program_studi text, p_jabatan text, p_email text, p_phone text, p_address text, p_photo text, p_soc_platform text[], p_soc_url text[], p_degree text[], p_major text[], p_institution text[], p_start_year integer[], p_end_year integer[], p_course_name text[], p_semester text[], p_cert_title text[], p_cert_issuer text[], p_cert_issue_date date[], p_cert_exp_date date[], p_cred_id text[], p_cred_url text[]) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    new_id INT;
    i INT;
BEGIN
    INSERT INTO members (
        nip, nidn, name, title_prefix, title_suffix,
        program_studi, jabatan, email, phone, address, photo,
        created_at
    )
    VALUES (
        p_nip, p_nidn, p_name, p_title_prefix, p_title_suffix,
        p_program_studi, p_jabatan, p_email, p_phone, p_address, p_photo,
        NOW()
    )
    RETURNING id INTO new_id;

    -----------------------------------------
    -- SOCIAL MEDIA
    -----------------------------------------
    IF p_soc_platform IS NOT NULL THEN
        FOR i IN 1..array_length(p_soc_platform, 1) LOOP
            INSERT INTO social_media (member_id, platform, url)
            VALUES (new_id, p_soc_platform[i], p_soc_url[i]);
        END LOOP;
    END IF;

    -----------------------------------------
    -- EDUCATIONS
    -----------------------------------------
    IF p_degree IS NOT NULL THEN
        FOR i IN 1..array_length(p_degree, 1) LOOP
            INSERT INTO educations (
                member_id, degree, major, institution,
                start_year, end_year
            )
            VALUES (
                new_id, p_degree[i], p_major[i], p_institution[i],
                p_start_year[i], p_end_year[i]
            );
        END LOOP;
    END IF;

    -----------------------------------------
    -- COURSES
    -----------------------------------------
    IF p_course_name IS NOT NULL THEN
        FOR i IN 1..array_length(p_course_name, 1) LOOP
            INSERT INTO courses (member_id, course_name, semester)
            VALUES (new_id, p_course_name[i], p_semester[i]);
        END LOOP;
    END IF;

    -----------------------------------------
    -- CERTIFICATIONS
    -----------------------------------------
    IF p_cert_title IS NOT NULL THEN
        FOR i IN 1..array_length(p_cert_title, 1) LOOP
            INSERT INTO certifications (
                member_id, title, issuer, issue_date,
                expiration_date, credential_id, credential_url
            )
            VALUES (
                new_id, p_cert_title[i], p_cert_issuer[i],
                p_cert_issue_date[i], p_cert_exp_date[i],
                p_cred_id[i], p_cred_url[i]
            );
        END LOOP;
    END IF;

    RETURN new_id;
END;
$$;


ALTER FUNCTION public.sp_insert_member_full(p_nip text, p_nidn text, p_name text, p_title_prefix text, p_title_suffix text, p_program_studi text, p_jabatan text, p_email text, p_phone text, p_address text, p_photo text, p_soc_platform text[], p_soc_url text[], p_degree text[], p_major text[], p_institution text[], p_start_year integer[], p_end_year integer[], p_course_name text[], p_semester text[], p_cert_title text[], p_cert_issuer text[], p_cert_issue_date date[], p_cert_exp_date date[], p_cred_id text[], p_cred_url text[]) OWNER TO postgres;

--
-- TOC entry 319 (class 1255 OID 164981)
-- Name: sp_insert_member_full(text, text, text, text, text, text, text, text, text, text, text, text[], text[], text[], text[], text[], text[], integer[], integer[], text[], text[], text[], text[], date[], date[], text[], text[]); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.sp_insert_member_full(p_nip text, p_nidn text, p_name text, p_title_prefix text, p_title_suffix text, p_program_studi text, p_jabatan text, p_email text, p_phone text, p_address text, p_photo text, p_soc_platform text[], p_soc_icon text[], p_soc_url text[], p_degree text[], p_major text[], p_institution text[], p_start_year integer[], p_end_year integer[], p_course_name text[], p_semester text[], p_cert_title text[], p_cert_issuer text[], p_cert_issue_date date[], p_cert_exp_date date[], p_cred_id text[], p_cred_url text[]) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    new_id INT;
    i INT;
BEGIN
    ---------------------------------------------------------
    -- CEK DUPLIKAT NIP
    ---------------------------------------------------------
    SELECT id INTO new_id 
    FROM members 
    WHERE nip = p_nip 
    LIMIT 1;

    IF new_id IS NOT NULL THEN
        RAISE NOTICE 'NIP % sudah ada, mengembalikan ID lama: %', p_nip, new_id;
        RETURN new_id;
    END IF;

    ---------------------------------------------------------
    -- INSERT MAIN MEMBER
    ---------------------------------------------------------
    INSERT INTO members (
        nip, nidn, name, title_prefix, title_suffix,
        program_studi, jabatan, email, phone, address, photo,
        created_at
    )
    VALUES (
        p_nip, p_nidn, p_name, p_title_prefix, p_title_suffix,
        p_program_studi, p_jabatan, p_email, p_phone, p_address, p_photo,
        NOW()
    )
    RETURNING id INTO new_id;

    ---------------------------------------------------------
    -- INSERT SOCIAL MEDIA
    ---------------------------------------------------------
    IF p_soc_platform IS NOT NULL THEN
        FOR i IN 1..array_length(p_soc_platform, 1) LOOP
            INSERT INTO social_media (member_id, platform, icon, url)
            VALUES (new_id, p_soc_platform[i], p_soc_icon[i], p_soc_url[i]);
        END LOOP;
    END IF;

    ---------------------------------------------------------
    -- INSERT EDUCATION
    ---------------------------------------------------------
    IF p_degree IS NOT NULL THEN
        FOR i IN 1..array_length(p_degree, 1) LOOP
            INSERT INTO educations (
                member_id, degree, major, institution,
                start_year, end_year
            )
            VALUES (
                new_id, p_degree[i], p_major[i],
                p_institution[i], p_start_year[i], p_end_year[i]
            );
        END LOOP;
    END IF;

    ---------------------------------------------------------
    -- INSERT COURSES
    ---------------------------------------------------------
    IF p_course_name IS NOT NULL THEN
        FOR i IN 1..array_length(p_course_name, 1) LOOP
            INSERT INTO courses (member_id, course_name, semester)
            VALUES (new_id, p_course_name[i], p_semester[i]);
        END LOOP;
    END IF;

    ---------------------------------------------------------
    -- INSERT CERTIFICATIONS
    ---------------------------------------------------------
    IF p_cert_title IS NOT NULL THEN
        FOR i IN 1..array_length(p_cert_title, 1) LOOP
            INSERT INTO certifications (
                member_id, title, issuer, issue_date, expiration_date,
                credential_id, credential_url
            )
            VALUES (
                new_id, p_cert_title[i], p_cert_issuer[i],
                p_cert_issue_date[i], p_cert_exp_date[i],
                p_cred_id[i], p_cred_url[i]
            );
        END LOOP;
    END IF;

    RETURN new_id;
END;
$$;


ALTER FUNCTION public.sp_insert_member_full(p_nip text, p_nidn text, p_name text, p_title_prefix text, p_title_suffix text, p_program_studi text, p_jabatan text, p_email text, p_phone text, p_address text, p_photo text, p_soc_platform text[], p_soc_icon text[], p_soc_url text[], p_degree text[], p_major text[], p_institution text[], p_start_year integer[], p_end_year integer[], p_course_name text[], p_semester text[], p_cert_title text[], p_cert_issuer text[], p_cert_issue_date date[], p_cert_exp_date date[], p_cred_id text[], p_cred_url text[]) OWNER TO postgres;

--
-- TOC entry 320 (class 1255 OID 173171)
-- Name: sp_update_member_full(integer, text, text, text, text, text, text, text, text, text, text, text, text[], text[], text[], text[], text[], text[], integer[], integer[], text[], text[], text[], text[], date[], date[], text[], text[]); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.sp_update_member_full(p_member_id integer, p_nip text, p_nidn text, p_name text, p_title_prefix text, p_title_suffix text, p_program_studi text, p_jabatan text, p_email text, p_phone text, p_address text, p_photo text, p_soc_platform text[], p_soc_icon text[], p_soc_url text[], p_degree text[], p_major text[], p_institution text[], p_start_year integer[], p_end_year integer[], p_course_name text[], p_semester text[], p_cert_title text[], p_cert_issuer text[], p_cert_issue_date date[], p_cert_exp_date date[], p_cred_id text[], p_cred_url text[]) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
    i INT;
BEGIN
    ---------------------------------------------------------
    -- UPDATE MAIN MEMBER
    ---------------------------------------------------------
    UPDATE members SET
        nip           = p_nip,
        nidn          = p_nidn,
        name          = p_name,
        title_prefix  = p_title_prefix,
        title_suffix  = p_title_suffix,
        program_studi = p_program_studi,
        jabatan       = p_jabatan,
        email         = p_email,
        phone         = p_phone,
        address       = p_address,
        photo         = p_photo,
        updated_at    = NOW()
    WHERE id = p_member_id;

    ---------------------------------------------------------
    -- DELETE OLD CHILD RECORDS
    ---------------------------------------------------------
    DELETE FROM social_media   WHERE member_id = p_member_id;
    DELETE FROM educations     WHERE member_id = p_member_id;
    DELETE FROM courses        WHERE member_id = p_member_id;
    DELETE FROM certifications WHERE member_id = p_member_id;

    ---------------------------------------------------------
    -- INSERT NEW SOCIAL MEDIA
    ---------------------------------------------------------
    IF p_soc_platform IS NOT NULL THEN
        FOR i IN 1..array_length(p_soc_platform, 1) LOOP
            INSERT INTO social_media (member_id, platform, icon, url)
            VALUES (p_member_id, p_soc_platform[i], p_soc_icon[i], p_soc_url[i]);
        END LOOP;
    END IF;

    ---------------------------------------------------------
    -- INSERT NEW EDUCATIONS
    ---------------------------------------------------------
    IF p_degree IS NOT NULL THEN
        FOR i IN 1..array_length(p_degree, 1) LOOP
            INSERT INTO educations (
                member_id, degree, major, institution, start_year, end_year
            )
            VALUES (
                p_member_id, p_degree[i], p_major[i],
                p_institution[i], p_start_year[i], p_end_year[i]
            );
        END LOOP;
    END IF;

    ---------------------------------------------------------
    -- INSERT NEW COURSES
    ---------------------------------------------------------
    IF p_course_name IS NOT NULL THEN
        FOR i IN 1..array_length(p_course_name, 1) LOOP
            INSERT INTO courses (member_id, course_name, semester)
            VALUES (p_member_id, p_course_name[i], p_semester[i]);
        END LOOP;
    END IF;

    ---------------------------------------------------------
    -- INSERT NEW CERTIFICATIONS
    ---------------------------------------------------------
    IF p_cert_title IS NOT NULL THEN
        FOR i IN 1..array_length(p_cert_title, 1) LOOP
            INSERT INTO certifications (
                member_id, title, issuer, issue_date, expiration_date,
                credential_id, credential_url
            )
            VALUES (
                p_member_id, p_cert_title[i], p_cert_issuer[i],
                p_cert_issue_date[i], p_cert_exp_date[i],
                p_cred_id[i], p_cred_url[i]
            );
        END LOOP;
    END IF;

    RETURN TRUE;
END;
$$;


ALTER FUNCTION public.sp_update_member_full(p_member_id integer, p_nip text, p_nidn text, p_name text, p_title_prefix text, p_title_suffix text, p_program_studi text, p_jabatan text, p_email text, p_phone text, p_address text, p_photo text, p_soc_platform text[], p_soc_icon text[], p_soc_url text[], p_degree text[], p_major text[], p_institution text[], p_start_year integer[], p_end_year integer[], p_course_name text[], p_semester text[], p_cert_title text[], p_cert_issuer text[], p_cert_issue_date date[], p_cert_exp_date date[], p_cred_id text[], p_cred_url text[]) OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 241 (class 1259 OID 132235)
-- Name: activities; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activities (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    description text,
    location character varying(255),
    date date,
    documentation character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.activities OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 132234)
-- Name: activities_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.activities_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.activities_id_seq OWNER TO postgres;

--
-- TOC entry 3682 (class 0 OID 0)
-- Dependencies: 240
-- Name: activities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.activities_id_seq OWNED BY public.activities.id;


--
-- TOC entry 243 (class 1259 OID 132246)
-- Name: activity_members; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activity_members (
    id integer NOT NULL,
    activity_id integer NOT NULL,
    member_id integer NOT NULL,
    role character varying(100)
);


ALTER TABLE public.activity_members OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 132245)
-- Name: activity_members_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.activity_members_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.activity_members_id_seq OWNER TO postgres;

--
-- TOC entry 3683 (class 0 OID 0)
-- Dependencies: 242
-- Name: activity_members_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.activity_members_id_seq OWNED BY public.activity_members.id;


--
-- TOC entry 261 (class 1259 OID 205939)
-- Name: activity_with_members; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.activity_with_members AS
SELECT
    NULL::integer AS id,
    NULL::character varying(255) AS title,
    NULL::text AS description,
    NULL::character varying(255) AS location,
    NULL::date AS date,
    NULL::character varying(255) AS documentation,
    NULL::timestamp without time zone AS created_at,
    NULL::timestamp without time zone AS updated_at,
    NULL::json AS members;


ALTER VIEW public.activity_with_members OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 124089)
-- Name: certifications; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.certifications (
    id integer NOT NULL,
    member_id integer,
    title character varying(255) NOT NULL,
    issuer character varying(255),
    issue_date date,
    expiration_date date,
    credential_id character varying(100),
    credential_url character varying(255)
);


ALTER TABLE public.certifications OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 124088)
-- Name: certifications_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.certifications_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.certifications_id_seq OWNER TO postgres;

--
-- TOC entry 3684 (class 0 OID 0)
-- Dependencies: 229
-- Name: certifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.certifications_id_seq OWNED BY public.certifications.id;


--
-- TOC entry 232 (class 1259 OID 124103)
-- Name: courses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.courses (
    id integer NOT NULL,
    member_id integer,
    semester character varying(10),
    course_name character varying(255) NOT NULL,
    CONSTRAINT courses_semester_check CHECK (((semester)::text = ANY ((ARRAY['Ganjil'::character varying, 'Genap'::character varying])::text[])))
);


ALTER TABLE public.courses OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 124102)
-- Name: courses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.courses_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.courses_id_seq OWNER TO postgres;

--
-- TOC entry 3685 (class 0 OID 0)
-- Dependencies: 231
-- Name: courses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.courses_id_seq OWNED BY public.courses.id;


--
-- TOC entry 237 (class 1259 OID 132213)
-- Name: lab_courses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lab_courses (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.lab_courses OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 124038)
-- Name: members; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.members (
    id integer NOT NULL,
    nip character varying(20),
    nidn character varying(20),
    name character varying(100) NOT NULL,
    title_prefix character varying(50),
    title_suffix character varying(50),
    program_studi character varying(100),
    jabatan character varying(100),
    email character varying(100),
    phone character varying(20),
    address text,
    photo character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.members OWNER TO postgres;

--
-- TOC entry 245 (class 1259 OID 132265)
-- Name: projects; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.projects (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    start_date date,
    end_date date,
    sponsor character varying(255),
    documentation character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.projects OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 124020)
-- Name: publications; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.publications (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    date date NOT NULL,
    link character varying(255) NOT NULL,
    member_id integer NOT NULL,
    description text,
    type character varying(100)
);


ALTER TABLE public.publications OWNER TO postgres;

--
-- TOC entry 248 (class 1259 OID 140403)
-- Name: dashboard_counts; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.dashboard_counts AS
 SELECT ( SELECT count(*) AS count
           FROM public.members) AS total_members,
    ( SELECT count(*) AS count
           FROM public.publications) AS total_publications,
    ( SELECT count(*) AS count
           FROM public.projects) AS total_projects,
    ( SELECT count(*) AS count
           FROM public.activities) AS total_activities,
    ( SELECT count(*) AS count
           FROM public.lab_courses) AS total_labs;


ALTER VIEW public.dashboard_counts OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 124075)
-- Name: educations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.educations (
    id integer NOT NULL,
    member_id integer,
    degree character varying(50),
    major character varying(255),
    institution character varying(255),
    start_year integer,
    end_year integer
);


ALTER TABLE public.educations OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 124074)
-- Name: educations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.educations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.educations_id_seq OWNER TO postgres;

--
-- TOC entry 3686 (class 0 OID 0)
-- Dependencies: 227
-- Name: educations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.educations_id_seq OWNED BY public.educations.id;


--
-- TOC entry 234 (class 1259 OID 124116)
-- Name: expertises; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.expertises (
    id integer NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE public.expertises OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 124115)
-- Name: expertises_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.expertises_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.expertises_id_seq OWNER TO postgres;

--
-- TOC entry 3687 (class 0 OID 0)
-- Dependencies: 233
-- Name: expertises_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.expertises_id_seq OWNED BY public.expertises.id;


--
-- TOC entry 222 (class 1259 OID 124029)
-- Name: facilities; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.facilities (
    id integer NOT NULL,
    slug character varying(50) NOT NULL,
    description text NOT NULL,
    image character varying(255)
);


ALTER TABLE public.facilities OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 124028)
-- Name: facilities_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.facilities_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.facilities_id_seq OWNER TO postgres;

--
-- TOC entry 3688 (class 0 OID 0)
-- Dependencies: 221
-- Name: facilities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.facilities_id_seq OWNED BY public.facilities.id;


--
-- TOC entry 236 (class 1259 OID 132212)
-- Name: lab_courses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lab_courses_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.lab_courses_id_seq OWNER TO postgres;

--
-- TOC entry 3689 (class 0 OID 0)
-- Dependencies: 236
-- Name: lab_courses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.lab_courses_id_seq OWNED BY public.lab_courses.id;


--
-- TOC entry 254 (class 1259 OID 148596)
-- Name: lab_information; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lab_information (
    id integer NOT NULL,
    key character varying(100) NOT NULL,
    value text NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.lab_information OWNER TO postgres;

--
-- TOC entry 253 (class 1259 OID 148595)
-- Name: lab_information_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lab_information_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.lab_information_id_seq OWNER TO postgres;

--
-- TOC entry 3690 (class 0 OID 0)
-- Dependencies: 253
-- Name: lab_information_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.lab_information_id_seq OWNED BY public.lab_information.id;


--
-- TOC entry 258 (class 1259 OID 148620)
-- Name: lab_missions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lab_missions (
    id integer NOT NULL,
    mission text NOT NULL,
    order_number integer DEFAULT 1,
    is_active boolean DEFAULT true,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.lab_missions OWNER TO postgres;

--
-- TOC entry 257 (class 1259 OID 148619)
-- Name: lab_missions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lab_missions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.lab_missions_id_seq OWNER TO postgres;

--
-- TOC entry 3691 (class 0 OID 0)
-- Dependencies: 257
-- Name: lab_missions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.lab_missions_id_seq OWNED BY public.lab_missions.id;


--
-- TOC entry 256 (class 1259 OID 148609)
-- Name: lab_vision; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lab_vision (
    id integer NOT NULL,
    vision text NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.lab_vision OWNER TO postgres;

--
-- TOC entry 255 (class 1259 OID 148608)
-- Name: lab_vision_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lab_vision_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.lab_vision_id_seq OWNER TO postgres;

--
-- TOC entry 3692 (class 0 OID 0)
-- Dependencies: 255
-- Name: lab_vision_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.lab_vision_id_seq OWNED BY public.lab_vision.id;


--
-- TOC entry 235 (class 1259 OID 124124)
-- Name: member_expertises; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.member_expertises (
    member_id integer NOT NULL,
    expertise_id integer NOT NULL
);


ALTER TABLE public.member_expertises OWNER TO postgres;

--
-- TOC entry 264 (class 1259 OID 214132)
-- Name: member_student; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.member_student (
    id integer NOT NULL,
    nim character varying(20) NOT NULL,
    name character varying(100) NOT NULL,
    program_studi character varying(100),
    semester integer,
    ipk numeric(3,2) NOT NULL,
    cv_path character varying(255) NOT NULL,
    portfolio_path character varying(255),
    motivation text NOT NULL,
    status character varying(20) DEFAULT 'pending'::character varying,
    email character varying(100) NOT NULL,
    phone character varying(20),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.member_student OWNER TO postgres;

--
-- TOC entry 263 (class 1259 OID 214131)
-- Name: member_student_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.member_student_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.member_student_id_seq OWNER TO postgres;

--
-- TOC entry 3693 (class 0 OID 0)
-- Dependencies: 263
-- Name: member_student_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.member_student_id_seq OWNED BY public.member_student.id;


--
-- TOC entry 223 (class 1259 OID 124037)
-- Name: members_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.members_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.members_id_seq OWNER TO postgres;

--
-- TOC entry 3694 (class 0 OID 0)
-- Dependencies: 223
-- Name: members_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.members_id_seq OWNED BY public.members.id;


--
-- TOC entry 247 (class 1259 OID 132276)
-- Name: project_members; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.project_members (
    id integer NOT NULL,
    project_id integer NOT NULL,
    member_id integer NOT NULL,
    role character varying(100)
);


ALTER TABLE public.project_members OWNER TO postgres;

--
-- TOC entry 246 (class 1259 OID 132275)
-- Name: project_members_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.project_members_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.project_members_id_seq OWNER TO postgres;

--
-- TOC entry 3695 (class 0 OID 0)
-- Dependencies: 246
-- Name: project_members_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.project_members_id_seq OWNED BY public.project_members.id;


--
-- TOC entry 262 (class 1259 OID 205944)
-- Name: project_with_members; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.project_with_members AS
SELECT
    NULL::integer AS id,
    NULL::character varying(255) AS name,
    NULL::text AS description,
    NULL::date AS start_date,
    NULL::date AS end_date,
    NULL::character varying(255) AS sponsor,
    NULL::character varying(255) AS documentation,
    NULL::timestamp without time zone AS created_at,
    NULL::timestamp without time zone AS updated_at,
    NULL::json AS members;


ALTER VIEW public.project_with_members OWNER TO postgres;

--
-- TOC entry 244 (class 1259 OID 132264)
-- Name: projects_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.projects_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.projects_id_seq OWNER TO postgres;

--
-- TOC entry 3696 (class 0 OID 0)
-- Dependencies: 244
-- Name: projects_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.projects_id_seq OWNED BY public.projects.id;


--
-- TOC entry 219 (class 1259 OID 124019)
-- Name: publications_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.publications_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.publications_id_seq OWNER TO postgres;

--
-- TOC entry 3697 (class 0 OID 0)
-- Dependencies: 219
-- Name: publications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.publications_id_seq OWNED BY public.publications.id;


--
-- TOC entry 239 (class 1259 OID 132224)
-- Name: research_focuses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.research_focuses (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    field character varying(100),
    description text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.research_focuses OWNER TO postgres;

--
-- TOC entry 238 (class 1259 OID 132223)
-- Name: research_focuses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.research_focuses_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.research_focuses_id_seq OWNER TO postgres;

--
-- TOC entry 3698 (class 0 OID 0)
-- Dependencies: 238
-- Name: research_focuses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.research_focuses_id_seq OWNED BY public.research_focuses.id;


--
-- TOC entry 216 (class 1259 OID 107658)
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    id integer NOT NULL,
    name character varying(50) NOT NULL
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 107657)
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.roles_id_seq OWNER TO postgres;

--
-- TOC entry 3699 (class 0 OID 0)
-- Dependencies: 215
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- TOC entry 226 (class 1259 OID 124063)
-- Name: social_media; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.social_media (
    id integer NOT NULL,
    member_id integer,
    platform character varying(100) NOT NULL,
    url character varying(255) NOT NULL,
    icon character varying(50)
);


ALTER TABLE public.social_media OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 124062)
-- Name: social_media_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.social_media_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.social_media_id_seq OWNER TO postgres;

--
-- TOC entry 3700 (class 0 OID 0)
-- Dependencies: 225
-- Name: social_media_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.social_media_id_seq OWNED BY public.social_media.id;


--
-- TOC entry 266 (class 1259 OID 214146)
-- Name: student_member_approval; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.student_member_approval (
    id integer NOT NULL,
    student_id integer NOT NULL,
    approved_by integer,
    status character varying(20) NOT NULL,
    note text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.student_member_approval OWNER TO postgres;

--
-- TOC entry 265 (class 1259 OID 214145)
-- Name: student_member_approval_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.student_member_approval_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.student_member_approval_id_seq OWNER TO postgres;

--
-- TOC entry 3701 (class 0 OID 0)
-- Dependencies: 265
-- Name: student_member_approval_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.student_member_approval_id_seq OWNED BY public.student_member_approval.id;


--
-- TOC entry 218 (class 1259 OID 107667)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(255) NOT NULL,
    role_id integer
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 107666)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- TOC entry 3702 (class 0 OID 0)
-- Dependencies: 217
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 260 (class 1259 OID 189555)
-- Name: v_member_full; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_member_full AS
SELECT
    NULL::integer AS id,
    NULL::character varying(20) AS nip,
    NULL::character varying(20) AS nidn,
    NULL::character varying(100) AS name,
    NULL::character varying(50) AS title_prefix,
    NULL::character varying(50) AS title_suffix,
    NULL::character varying(100) AS program_studi,
    NULL::character varying(100) AS jabatan,
    NULL::character varying(100) AS email,
    NULL::character varying(20) AS phone,
    NULL::text AS address,
    NULL::character varying(255) AS photo,
    NULL::timestamp without time zone AS created_at,
    NULL::timestamp without time zone AS updated_at,
    NULL::json AS social_media,
    NULL::json AS educations,
    NULL::json AS courses,
    NULL::json AS certifications,
    NULL::json AS publications,
    NULL::json AS expertises;


ALTER VIEW public.v_member_full OWNER TO postgres;

--
-- TOC entry 251 (class 1259 OID 140415)
-- Name: view_activities_per_month; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.view_activities_per_month AS
 SELECT to_char((activities.date)::timestamp with time zone, 'YYYY-MM'::text) AS month,
    count(*) AS total
   FROM public.activities
  GROUP BY (to_char((activities.date)::timestamp with time zone, 'YYYY-MM'::text))
  ORDER BY (to_char((activities.date)::timestamp with time zone, 'YYYY-MM'::text));


ALTER VIEW public.view_activities_per_month OWNER TO postgres;

--
-- TOC entry 252 (class 1259 OID 140419)
-- Name: view_member_expertise; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.view_member_expertise AS
 SELECT e.name AS expertise,
    count(*) AS total
   FROM (public.member_expertises me
     JOIN public.expertises e ON ((me.expertise_id = e.id)))
  GROUP BY e.name
  ORDER BY (count(*)) DESC;


ALTER VIEW public.view_member_expertise OWNER TO postgres;

--
-- TOC entry 259 (class 1259 OID 181363)
-- Name: view_member_full; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.view_member_full AS
 SELECT m.id AS member_id,
    m.nip,
    m.nidn,
    m.name,
    m.title_prefix,
    m.title_suffix,
    m.program_studi,
    m.jabatan,
    m.email,
    m.phone,
    m.address,
    m.photo,
    m.created_at,
    sm.id AS social_id,
    sm.platform AS social_platform,
    sm.icon AS social_icon,
    sm.url AS social_url,
    e.id AS education_id,
    e.degree,
    e.major,
    e.institution,
    e.start_year,
    e.end_year,
    c.id AS course_id,
    c.course_name,
    c.semester,
    cert.id AS certification_id,
    cert.title AS cert_title,
    cert.issuer AS cert_issuer,
    cert.issue_date,
    cert.expiration_date,
    cert.credential_id,
    cert.credential_url,
    p.id AS publication_id,
    p.title AS publication_title,
    p.date AS publication_date,
    p.link AS publication_link,
    p.description AS publication_description,
    p.type AS publication_type
   FROM (((((public.members m
     LEFT JOIN public.social_media sm ON ((sm.member_id = m.id)))
     LEFT JOIN public.educations e ON ((e.member_id = m.id)))
     LEFT JOIN public.courses c ON ((c.member_id = m.id)))
     LEFT JOIN public.certifications cert ON ((cert.member_id = m.id)))
     LEFT JOIN public.publications p ON ((p.member_id = m.id)));


ALTER VIEW public.view_member_full OWNER TO postgres;

--
-- TOC entry 250 (class 1259 OID 140411)
-- Name: view_projects_per_year; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.view_projects_per_year AS
 SELECT EXTRACT(year FROM projects.start_date) AS year,
    count(*) AS total
   FROM public.projects
  GROUP BY (EXTRACT(year FROM projects.start_date))
  ORDER BY (EXTRACT(year FROM projects.start_date));


ALTER VIEW public.view_projects_per_year OWNER TO postgres;

--
-- TOC entry 249 (class 1259 OID 140407)
-- Name: view_publications_per_year; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.view_publications_per_year AS
 SELECT EXTRACT(year FROM publications.date) AS year,
    count(*) AS total
   FROM public.publications
  GROUP BY (EXTRACT(year FROM publications.date))
  ORDER BY (EXTRACT(year FROM publications.date));


ALTER VIEW public.view_publications_per_year OWNER TO postgres;

--
-- TOC entry 3375 (class 2604 OID 132238)
-- Name: activities id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activities ALTER COLUMN id SET DEFAULT nextval('public.activities_id_seq'::regclass);


--
-- TOC entry 3378 (class 2604 OID 132249)
-- Name: activity_members id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_members ALTER COLUMN id SET DEFAULT nextval('public.activity_members_id_seq'::regclass);


--
-- TOC entry 3366 (class 2604 OID 124092)
-- Name: certifications id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.certifications ALTER COLUMN id SET DEFAULT nextval('public.certifications_id_seq'::regclass);


--
-- TOC entry 3367 (class 2604 OID 124106)
-- Name: courses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courses ALTER COLUMN id SET DEFAULT nextval('public.courses_id_seq'::regclass);


--
-- TOC entry 3365 (class 2604 OID 124078)
-- Name: educations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.educations ALTER COLUMN id SET DEFAULT nextval('public.educations_id_seq'::regclass);


--
-- TOC entry 3368 (class 2604 OID 124119)
-- Name: expertises id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.expertises ALTER COLUMN id SET DEFAULT nextval('public.expertises_id_seq'::regclass);


--
-- TOC entry 3360 (class 2604 OID 124032)
-- Name: facilities id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.facilities ALTER COLUMN id SET DEFAULT nextval('public.facilities_id_seq'::regclass);


--
-- TOC entry 3369 (class 2604 OID 132216)
-- Name: lab_courses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lab_courses ALTER COLUMN id SET DEFAULT nextval('public.lab_courses_id_seq'::regclass);


--
-- TOC entry 3383 (class 2604 OID 148599)
-- Name: lab_information id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lab_information ALTER COLUMN id SET DEFAULT nextval('public.lab_information_id_seq'::regclass);


--
-- TOC entry 3389 (class 2604 OID 148623)
-- Name: lab_missions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lab_missions ALTER COLUMN id SET DEFAULT nextval('public.lab_missions_id_seq'::regclass);


--
-- TOC entry 3386 (class 2604 OID 148612)
-- Name: lab_vision id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lab_vision ALTER COLUMN id SET DEFAULT nextval('public.lab_vision_id_seq'::regclass);


--
-- TOC entry 3394 (class 2604 OID 214135)
-- Name: member_student id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.member_student ALTER COLUMN id SET DEFAULT nextval('public.member_student_id_seq'::regclass);


--
-- TOC entry 3361 (class 2604 OID 124041)
-- Name: members id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.members ALTER COLUMN id SET DEFAULT nextval('public.members_id_seq'::regclass);


--
-- TOC entry 3382 (class 2604 OID 132279)
-- Name: project_members id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_members ALTER COLUMN id SET DEFAULT nextval('public.project_members_id_seq'::regclass);


--
-- TOC entry 3379 (class 2604 OID 132268)
-- Name: projects id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects ALTER COLUMN id SET DEFAULT nextval('public.projects_id_seq'::regclass);


--
-- TOC entry 3359 (class 2604 OID 124023)
-- Name: publications id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publications ALTER COLUMN id SET DEFAULT nextval('public.publications_id_seq'::regclass);


--
-- TOC entry 3372 (class 2604 OID 132227)
-- Name: research_focuses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.research_focuses ALTER COLUMN id SET DEFAULT nextval('public.research_focuses_id_seq'::regclass);


--
-- TOC entry 3357 (class 2604 OID 107661)
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- TOC entry 3364 (class 2604 OID 124066)
-- Name: social_media id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.social_media ALTER COLUMN id SET DEFAULT nextval('public.social_media_id_seq'::regclass);


--
-- TOC entry 3398 (class 2604 OID 214149)
-- Name: student_member_approval id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.student_member_approval ALTER COLUMN id SET DEFAULT nextval('public.student_member_approval_id_seq'::regclass);


--
-- TOC entry 3358 (class 2604 OID 107670)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 3659 (class 0 OID 132235)
-- Dependencies: 241
-- Data for Name: activities; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.activities (id, title, description, location, date, documentation, created_at, updated_at) FROM stdin;
8	Data Science Meetup	Discussion on data analysis like a man	Lab A	2022-07-05	uploads/activities/1765760704_1764594333_1764594294_sigmund-Fa9b57hffnM-unsplash.jpg	2025-11-17 20:42:48.564241	2025-12-15 08:05:04.281876
7	IoT Expo	Exhibition of IoT projects	Lab C	2021-06-10	uploads/activities/1765760714_1764594328_The 2G2BT Hinge-Top Presentation Station with Side….jpeg	2025-11-17 20:42:48.564241	2025-12-15 08:05:14.941222
19	Workshop & Seminar	Kegiatan pelatihan internal, seminar, dan workshop untuk pengembangan keterampilan teknologi data.		2025-12-15	uploads/activities/1765782264_22172142925_5aec22646f_o.jpg	2025-12-15 13:48:37.79237	2025-12-15 14:04:24.608141
\.


--
-- TOC entry 3661 (class 0 OID 132246)
-- Dependencies: 243
-- Data for Name: activity_members; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.activity_members (id, activity_id, member_id, role) FROM stdin;
48	8	63	\N
49	8	62	\N
50	7	63	\N
51	7	65	\N
\.


--
-- TOC entry 3648 (class 0 OID 124089)
-- Dependencies: 230
-- Data for Name: certifications; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.certifications (id, member_id, title, issuer, issue_date, expiration_date, credential_id, credential_url) FROM stdin;
46	62	Machine Learning Research	IEEE	2021-06-01	2025-12-31	CERT-002	https://example.com
47	65	Data Visualization	Tableau	2021-01-01	2025-12-17	CERT-005	https://example.com
50	61	Data Science Professional	International Board	2020-01-01	2025-12-31	CERT-001	https://example.com
51	61	Information Technology Specialist in Artificial Intelligence	Certiport - A Pearson VUE Business	2024-10-15	2026-12-15		
52	61	English Proficiency Certificate	Duolingo English Test	2024-01-15	2026-01-15		
53	61	HackerRank SQL (Intermediate	HackerRank	2022-12-15	2025-12-15		
54	61	HackerRank Java (Basic)	HackerRank	2022-05-15	2025-12-15		
55	61	HackerRank SQL (Basic)	Hackerrank	2022-05-05	2025-12-15		
56	61	CPE (Collegiate Programming Examination)	National Sun Yat-sen University, Taiwan	2025-12-15	2025-12-15		
57	63	Database Engineer	Oracle	2019-01-01	2025-12-31	CERT-003	https://example.com
58	64	AI Research	Elsevier	2022-01-01	2025-12-16	CERT-004	https://example.com
\.


--
-- TOC entry 3650 (class 0 OID 124103)
-- Dependencies: 232
-- Data for Name: courses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.courses (id, member_id, semester, course_name) FROM stdin;
60	62	Genap	Analisis Data
61	65	Ganjil	Visualisasi Data
64	61	Genap	Big Data
65	61	Genap	Cloud Computing
66	61	Ganjil	Proyek Teknologi Terintegrasi
67	63	Ganjil	Database
68	63	Genap	Pengembangan Perangkat Lunak
69	63	Genap	Pemrograman Web
70	63	Genap	Pemrograman Jaringan
71	63	Genap	Jaringan Komputer
72	66	Genap	Proyek Sistem Informasi
73	66	Genap	Cloud Computing
74	66	Genap	Big Data
75	66	Genap	Analisis dan Desain Berorientasi Objek
76	66	Ganjil	Praktikum Basis Data Lanjut
77	66	Ganjil	Basis Data Lanjut
78	64	Genap	Machine Learning
\.


--
-- TOC entry 3646 (class 0 OID 124075)
-- Dependencies: 228
-- Data for Name: educations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.educations (id, member_id, degree, major, institution, start_year, end_year) FROM stdin;
46	62	S2	Ilmu Komputer	ITS	2015	\N
47	65	S2	Informatika	ITS	2014	\N
50	61	S2	 Computer Science and Information Engineering	Chang Gung University	2016	\N
51	61	D4	Teknik Informatika	Politeknik Elektronika Negeri Surabaya	2013	\N
52	61	D3	 Manajemen Informatika	Politeknik Negeri Malang	2010	\N
53	63	S2	 Magister Manajemen Sistem Informasi	Universitas Gunadarma	2010	\N
54	63	S1	Sarjana Komputer	STMIK PPKIA Pradnya Paramita	2005	\N
55	66	S1	Teknik Informatika	Universitas Trunojoyo Madura	2014	\N
56	66	S2	Teknik Informatika	Institut Teknologi Bandung	2018	\N
57	64	S3	Computer Science	International University	2012	\N
\.


--
-- TOC entry 3652 (class 0 OID 124116)
-- Dependencies: 234
-- Data for Name: expertises; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.expertises (id, name) FROM stdin;
1	Software Engineering
2	Artificial Intelligence
3	Information Systems
4	Database
5	Programming
9	Analisis Data
10	Big Data
11	Machine Learning
12	Visualisasi Data
13	Data Mining
14	Database & SQL
\.


--
-- TOC entry 3640 (class 0 OID 124029)
-- Dependencies: 222
-- Data for Name: facilities; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.facilities (id, slug, description, image) FROM stdin;
4	Ruang Praktikum & Penelitian	Ruang laboratorium yang nyaman untuk kegiatan praktikum, eksperimen, dan penelitian	uploads/facilities/1765780972_1764812922_1764593856_Computer classroom on Behance.jpeg
3	Perangkat Lunak	Software analisis data, machine learning, serta tools big data untuk kebutuhan riset dan pembelajaran	uploads/facilities/1765781003_1764812824_1764593770_Big wall to fill_ Used home row in the middle, on….jpeg
1	Perangkat Komputer	Dilengkapi perangkat komputer berperforma tinggi untuk mendukung praktikum dan penelitian data.	uploads/facilities/1765781025_1764812886_1764593843_The 2G2BT Hinge-Top Presentation Station with Side….jpeg
2	Meja Meeting	Meja untuk kebutuhan diskusi dan belajar untuk semua anggota Lab Data Tekonologi	uploads/facilities/1765781069_1764812939_1764593656_sigmund-Fa9b57hffnM-unsplash.jpg
\.


--
-- TOC entry 3655 (class 0 OID 132213)
-- Dependencies: 237
-- Data for Name: lab_courses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lab_courses (id, name, description, created_at, updated_at) FROM stdin;
6	Big Data	Pemrosesan data skala besar menggunakan Hadoop & Spark	2025-12-15 07:43:04.550439	2025-12-15 07:43:04.550439
7	Data Warehouse	Desain gudang data untuk integrasi & analisis data	2025-12-15 07:43:04.550439	2025-12-15 07:43:04.550439
8	Basis Data Lanjut	Optimasi query dan manajemen data tingkat lanjut	2025-12-15 07:43:04.550439	2025-12-15 07:43:04.550439
\.


--
-- TOC entry 3667 (class 0 OID 148596)
-- Dependencies: 254
-- Data for Name: lab_information; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lab_information (id, key, value, created_at, updated_at) FROM stdin;
3	site_name	Laboratorium Data & Teknologi	2025-11-23 20:43:00.35958	2025-11-23 20:43:00.35958
10	email	labdatatek@polinema.ac.id	2025-11-23 20:43:00.35958	2025-11-23 20:43:00.35958
11	phone	+62 812-3456-7890	2025-11-23 20:43:00.35958	2025-11-23 20:43:00.35958
12	instagram	https://instagram.com/labdatatek	2025-11-23 20:43:00.35958	2025-11-23 20:43:00.35958
14	hero_background	assets/img/logo/hero-bg.jpg	2025-11-23 20:43:00.35958	2025-11-23 20:43:00.35958
6	hero_subtitle	Membangun masa depan dengan inovasi teknologi dan analisis data	2025-11-23 20:43:00.35958	2025-11-24 19:44:53.850222
15	about_subtitle	Data & Teknologi	2025-11-24 20:03:30.356256	2025-11-24 20:03:30.356256
16	about_highlight	Laboratorium data & teknologi	2025-11-24 20:05:56.684217	2025-11-24 20:05:56.684217
8	about_description	adalah laboratorium yang berfokus pada pengembangan kapasitas mahasiswa dalam bidang analisis data, teknologi informasi, dan inovasi digital. Kami berkomitmen untuk menciptakan lingkungan pembelajaran yang mendukung riset dan pengembangan teknologi terkini.	2025-11-23 20:43:00.35958	2025-11-24 20:08:06.166277
17	visi_title	Visi & Misi	2025-11-24 20:16:58.004871	2025-11-24 20:16:58.004871
18	visi_subtitle	Arah dan tujuan kami dalam mengembangkan teknologi dan pendidikan	2025-11-24 20:17:47.080548	2025-11-24 20:17:47.080548
13	logo	public/assets/img/logo/logo-icon.png	2025-11-23 20:43:00.35958	2025-11-24 20:42:16.257719
4	tagline	Membangun masa depan dengan inovasi teknologi dan analisis data yang berkelanjutan.	2025-11-23 20:43:00.35958	2025-11-24 20:52:52.275199
19	facebook	https://www.facebook.com/profile.php?id=100033483314877	2025-11-24 21:28:13.55966	2025-11-24 21:28:13.55966
20	twitter	https://x.com/?lang=en	2025-11-24 21:28:49.210481	2025-11-24 21:28:49.210481
21	linkedin	https://www.linkedin.com/in/yoppy	2025-11-24 21:29:13.09655	2025-11-24 21:29:13.09655
7	about_title	Tentang Laboratorium	2025-11-23 20:43:00.35958	2025-12-04 11:26:28.479936
9	address	Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141	2025-11-23 20:43:00.35958	2025-12-15 08:25:12.681677
5	hero_title	Laboratorium Data & Teknologi POLINEMA	2025-11-23 20:43:00.35958	2025-12-15 15:29:07.467391
\.


--
-- TOC entry 3671 (class 0 OID 148620)
-- Dependencies: 258
-- Data for Name: lab_missions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lab_missions (id, mission, order_number, is_active, created_at, updated_at) FROM stdin;
2	Menyelenggarakan pendidikan berkualitas di bidang data dan teknologi	1	t	2025-11-23 21:21:48.459738	2025-11-23 21:21:48.459738
3	Melakukan riset yang inovatif dan aplikatif	2	t	2025-11-23 21:26:39.87766	2025-11-23 21:26:39.87766
4	Membangun kolaborasi dengan industri dan institusi	3	t	2025-11-23 21:27:11.435301	2025-11-23 21:27:11.435301
5	Mengembangkan solusi teknologi untuk masyarakat	4	t	2025-11-23 21:27:24.063753	2025-11-23 21:27:24.063753
6	qwertyuiuyewertyuiuytrewertyui	5	t	2025-11-24 11:19:24.466586	2025-11-24 11:19:24.466586
\.


--
-- TOC entry 3669 (class 0 OID 148609)
-- Dependencies: 256
-- Data for Name: lab_vision; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lab_vision (id, vision, created_at, updated_at) FROM stdin;
2	Menjadi pusat keunggulan dalam pendidikan dan riset data science serta teknologi informasi yang menghasilkan lulusan berkualitas dan inovasi yang berdampak pada masyarakat.	2025-11-23 21:03:23.308192	2025-11-23 21:56:50.93689
\.


--
-- TOC entry 3653 (class 0 OID 124124)
-- Dependencies: 235
-- Data for Name: member_expertises; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.member_expertises (member_id, expertise_id) FROM stdin;
62	3
62	9
65	2
65	3
65	4
61	1
61	2
61	3
61	4
61	5
63	5
63	9
63	10
66	3
64	3
64	4
64	9
\.


--
-- TOC entry 3673 (class 0 OID 214132)
-- Dependencies: 264
-- Data for Name: member_student; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.member_student (id, nim, name, program_studi, semester, ipk, cv_path, portfolio_path, motivation, status, email, phone, created_at, updated_at) FROM stdin;
9	244107020051	Diragon	Teknik Informatika	4	3.00	public/uploads/member_students/cv_1765114216_693581682d762.pdf	\N	se	rejected	fajar.sekawanmedia@gmail.com	087712383764	2025-12-07 20:30:16.190786	2025-12-07 20:30:53.459187
10	244107020052	Ekaaaa	Kehutanan	4	3.00	public/uploads/member_students/cv_1765114686_6935833eb68a5.pdf	\N	kenapaaa	rejected	fajar.sekawanmedia@gmail.com	087712383764	2025-12-07 20:38:06.750404	2025-12-07 20:38:34.998351
11	244107020053	Okeeeee selamattt	Seni	3	4.00	public/uploads/member_students/cv_1765115021_6935848d634a9.pdf	\N	okeeee	approved	fajar.sekawanmedia@gmail.com	087712383764	2025-12-07 20:43:41.409268	2025-12-07 20:45:00.072571
1	244107020043	Fajar Eka Sandiyuda	Teknik Informatika	3	3.94	public/uploads/member_students/cv_1765014940_6933fd9c8210c.pdf	\N	Saya suka beelajar dengan giat dan saya merupakan mahasiswa yang suka dengan tantangan dan saya juga ingin menjadi mahasiswa yang berprestasi	approved	fajar.sekawanmedia@gmail.com	087712383764	2025-12-06 16:55:40.571171	2025-12-07 18:08:55.926443
2	244107020044	Trueman	Kehutanan	4	4.00	public/uploads/member_students/cv_1765015522_6933ffe29f968.pdf	\N	saya ingi menjalankan misi mulia dengan menyebarkan agama saya di politeknik negeri malang	rejected	admin@example.com	087712383764	2025-12-06 17:05:22.660416	2025-12-07 18:12:54.031655
3	244107020045	Kishibe Rohan	Seni	10	4.00	public/uploads/member_students/cv_1765015611_6934003b2587e.pdf	\N	Saya ingin menerapkan kejadian di dunia nyata sebagai referensi manga yang saya buat, dan asaya akan melakukan apapun denmi mengalami pengalaman yang baru	approved	fajar.sekawanmedia@gmail.com	087712383764	2025-12-06 17:06:51.15822	2025-12-07 20:04:22.67576
13	244107020054	Holy Gangs	Teknik Informatika	3	3.00	public/uploads/member_students/cv_1765116978_69358c3220050.pdf	\N	motivasi saya adalah untuk membangun sebuah kultus	approved	fajar.sekawanmedia@gmail.com	087712383764	2025-12-07 21:16:18.133936	2025-12-07 21:17:22.678667
4	244107020046	JIMMY HENDRIK	Teknik Informatika	4	4.00	public/uploads/member_students/cv_1765016388_693403444cfc7.pdf	\N	Saya ingin menjadi gityaris legendaris	rejected	fajar.sekawanmedia@gmail.com	087712383764	2025-12-06 17:19:48.338157	2025-12-07 20:06:53.359124
6	244107020047	Akira Toriyama	Teknik Informatika	2	3.00	public/uploads/member_students/cv_1765022953_69341ce902163.pdf	\N	saya ingin belajar giat	rejected	fajar.sekawanmedia@gmail.com	087712383764	2025-12-06 19:09:13.011477	2025-12-07 20:07:30.752399
8	244107020049	Joker 2	Teknik Informatika	3	3.00	public/uploads/member_students/cv_1765113323_69357debd31df.pdf	\N	Saya menganut ajaran baru yang bernama ajaran memuja gelembung ajaib	approved	fajar.sekawanmedia@gmail.com	087712383764	2025-12-07 20:15:23.871525	2025-12-07 20:16:13.727403
14	244107020055	Lucifer	Kehutanan	4	3.00	public/uploads/member_students/cv_1765117023_69358c5f1b985.pdf	public/uploads/member_students/portfolio_1765117023_69358c5f1c0f5.pdf	saya bergabung karena saya ingin	rejected	fajar.sekawanmedia@gmail.com	087712383764	2025-12-07 21:17:03.118451	2025-12-07 21:17:36.991512
15	244107020057	Sumargo sego pecel	Kehutanan	8	3.00	public/uploads/member_students/cv_1765133075_6935cb13a18a5.pdf	\N	saya sangat ingin bergabung	approved	fajar.sekawanmedia@gmail.com	087712383764	2025-12-08 01:44:35.688435	2025-12-08 01:45:49.441277
16	244107020059	Fajar Eka Sandiyuda	Teknik Informatika	3	3.00	public/uploads/member_students/cv_1765157958_69362c465cf68.pdf	\N	saya pengen	approved	arafass2706@gmail.com	087712383764	2025-12-08 08:39:18.389951	2025-12-08 08:39:41.27037
17	244107020090	Fajar Eka Sandiyuda	Teknik Informatika	2	4.00	public/uploads/member_students/cv_1765788131_693fc9e3ac080.pdf	\N	SAY INGIN JOIN	approved	fajar.sekawanmedia@gmail.com	087712383764	2025-12-15 15:42:11.71211	2025-12-15 15:42:52.021377
18	244107020098	Fajar Eka Sandiyuda	Teknik Informatika	3	3.00	public/uploads/member_students/cv_1765788423_693fcb077bf74.pdf	\N	SAYA MAU JOIN	rejected	fajar.sekawanmedia@gmail.com	087712383764	2025-12-15 15:47:03.513509	2025-12-15 15:48:03.107182
\.


--
-- TOC entry 3642 (class 0 OID 124038)
-- Dependencies: 224
-- Data for Name: members; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.members (id, nip, nidn, name, title_prefix, title_suffix, program_studi, jabatan, email, phone, address, photo, created_at, updated_at) FROM stdin;
62	199003052019031013	0005039007	M. Hasyim Ratsanjani	S.Kom.	M.Kom	Teknologi Informasi	anggota	hasyim@polinema.ac.id	081335951749	Politeknik Negeri Malang	uploads/members/1765760465_image.png	2025-12-15 07:51:52.524206	2025-12-15 08:01:05.873247
65	198901092020122005	0009018910	Vit Zuraida	S.Kom.	M.Kom	Teknologi Informasi	anggota	vit@polinema.ac.id	081335951749	Politeknik Negeri Malang	uploads/members/1765760530_image.png	2025-12-15 07:52:59.370166	2025-12-15 08:02:10.120084
61	198906212019031013	0021068905	Yoppy Yunhasnawa	S.ST.	M.Sc	Teknologi Informasi	ketua	yunhasnawa@polinema.ac.id	081335951749	Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141	uploads/members/1765778579_1765760647_image.png	2025-12-15 07:51:28.131541	2025-12-15 13:02:59.53875
63	198211302014041001	0730118201	Luqman Affandi	S.Kom.	M.MSI	Teknologi Informasi	anggota	luqman@polinema.ac.id	081335951749	Politeknik Negeri Malang	uploads/members/1765779060_citations.jpg	2025-12-15 07:52:13.107675	2025-12-15 13:11:00.419364
66	199204122019031013		Habibie Ed Dien, S.Kom., M.T.			Teknik Informatika	anggota	habibie@polinema.ac.id		Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141	uploads/members/1765779988_Habibie-Ed-Dien.jpg	2025-12-15 13:26:28.337858	2025-12-15 13:26:28.337858
64	197704242008121001	0024047706	Gunawan Budi Prasetyo	ST.	MT., Ph.D	Teknologi Informasi	anggota	gunawan@polinema.ac.id	081335951749	Politeknik Negeri Malang	uploads/members/1765998442_What song got u like this_.jpeg	2025-12-15 07:52:34.895217	2025-12-18 02:07:22.183718
\.


--
-- TOC entry 3665 (class 0 OID 132276)
-- Dependencies: 247
-- Data for Name: project_members; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.project_members (id, project_id, member_id, role) FROM stdin;
48	5	64	\N
49	5	63	\N
50	5	62	\N
\.


--
-- TOC entry 3663 (class 0 OID 132265)
-- Dependencies: 245
-- Data for Name: projects; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.projects (id, name, description, start_date, end_date, sponsor, documentation, created_at, updated_at) FROM stdin;
5	AI Research	Artificial Intelligence project	2022-02-01	2022-12-15	Universitas A	uploads/projects/1765760741_1764594356_Big wall to fill_ Used home row in the middle, on….jpeg	2025-11-17 20:42:14.96722	2025-12-15 08:05:41.760704
14	Praktikum Mahasiswa	Kegiatan pembelajaran berbasis praktik untuk memperdalam pemahaman teknologi data.	2025-12-15	2025-12-15		uploads/projects/1765781265_download.jpg	2025-12-15 13:47:45.922142	2025-12-15 13:47:45.922142
\.


--
-- TOC entry 3638 (class 0 OID 124020)
-- Dependencies: 220
-- Data for Name: publications; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.publications (id, title, date, link, member_id, description, type) FROM stdin;
21	Manajemen Basis Data Terdistribusi pada Sistem Akademik	2023-07-25	https://example.com/publications/db-terdistribusi	63	Pengelolaan database terdistribusi untuk meningkatkan skalabilitas sistem akademik.	Jurnal
23	Machine Learning untuk Deteksi Pola Prestasi Mahasiswa	2024-01-30	https://example.com/publications/ml-prestasi	64	Pemanfaatan machine learning dalam mendeteksi pola prestasi mahasiswa.	Jurnal
22	Integrasi Data Akademik Menggunakan ETL	2022-05-12	https://example.com/publications/etl-akademik	63	Implementasi proses ETL untuk integrasi data akademik lintas sistem.	Jurnal
26	Dashboard Analitik Berbasis Web untuk Pengambilan Keputusan	2023-08-21	https://example.com/publications/dashboard-analitik	65	Pembuatan dashboard analitik berbasis web untuk mendukung pengambilan keputusan.	Konferensi
18	Arsitektur Data Warehouse pada Sistem Informasi Pendidikan	2023-10-02	https://example.com/publications/data-warehouse-pendidikan	61	Perancangan data warehouse untuk mendukung pengambilan keputusan di institusi pendidikan.	Konferensi
19	Analisis Data Mining untuk Prediksi Kelulusan Mahasiswa	2024-03-20	https://example.com/publications/data-mining-kelulusan	62	Penerapan teknik data mining untuk memprediksi tingkat kelulusan mahasiswa.	Jurnal
24	Evaluasi Model Klasifikasi pada Dataset Pendidikan	2023-09-14	https://example.com/publications/model-klasifikasi	64	Perbandingan performa beberapa model klasifikasi pada dataset pendidikan.	Konferensi
20	Optimasi Query SQL pada Basis Data Skala Besar	2022-11-18	https://example.com/publications/optimasi-sql	62	Studi optimasi performa query SQL pada database dengan volume data besar.	Konferensi
17	Penerapan Big Data Analytics untuk Evaluasi Kinerja Akademik	2024-06-15	https://example.com/publications/big-data-akademik	61	Penelitian mengenai pemanfaatan big data analytics dalam evaluasi kinerja akademik mahasiswa.	Jurnal
25	Visualisasi Data Interaktif untuk Monitoring Akademik	2024-04-10	https://example.com/publications/visualisasi-akademik	65	Pengembangan dashboard visualisasi data interaktif untuk monitoring akademik.	Jurnal
\.


--
-- TOC entry 3657 (class 0 OID 132224)
-- Dependencies: 239
-- Data for Name: research_focuses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.research_focuses (id, title, field, description, created_at, updated_at) FROM stdin;
7	Analisis Data Big Data & Hadoop	Big Data	Fokus pada pemrosesan dan analisis dataset berukuran besar	2025-12-15 07:42:12.714146	2025-12-15 07:42:12.714146
8	Machine Learning & Data Mining	Machine Learning	Penelitian terkait model prediktif dan teknik pattern discovery	2025-12-15 07:42:12.714146	2025-12-15 07:42:12.714146
10	Pengelolaan Database & SQL	Database	Optimasi query, perancangan database, manajemen data	2025-12-15 07:42:12.714146	2025-12-15 07:42:12.714146
\.


--
-- TOC entry 3634 (class 0 OID 107658)
-- Dependencies: 216
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles (id, name) FROM stdin;
7	rahma bunda
9	louis
10	Joko Widodo
2	admin
11	AI Research
\.


--
-- TOC entry 3644 (class 0 OID 124063)
-- Dependencies: 226
-- Data for Name: social_media; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.social_media (id, member_id, platform, url, icon) FROM stdin;
52	61	LinkedIn	https://linkedin.com	fa-linkedin
53	61	Google Scholar	https://scholar.google.com/citations?user=A_KvRKUAAAAJ&hl=id	fas fa-graduation-cap
54	61	Sinta	https://sinta.kemdiktisaintek.go.id/authors/profile/6681213	fas fa-university
55	61	YouTube	https://www.youtube.com/c/YoppyYunhasnawa/videos	fab fa-youtube
56	61	GitHub	https://github.com/yunhasnawa	fab fa-github
57	63	LinkedIn	https://linkedin.com	fa-linkedin
58	63	Google Scholar	https://scholar.google.com/citations?user=_FVUDowAAAAJ&hl=id	fas fa-graduation-cap
59	63	Sinta	https://sinta.kemdiktisaintek.go.id/authors/profile/6018763	fas fa-university
60	63	ResearchGate	https://www.researchgate.net/profile/Luqman-Affandi	fab fa-researchgate
61	66	LinkedIn	https://www.linkedin.com/in/habibieeddien/	fab fa-linkedin
62	66	Google Scholar	https://scholar.google.com/citations?hl=en&user=Gps_SrkAAAAJ	fas fa-graduation-cap
63	66	Sinta	https://sinta.kemdiktisaintek.go.id/authors/profile/6713413	fas fa-university
64	64	Scopus	https://scopus.com	fa-book
65	64	LinkedIn	https://id.linkedin.com/in/gunawan-budiprasetyo-96b22a305	fab fa-linkedin
66	64	Instagram	https://www.instagram.com/gunawanbudiprasetyo/	fab fa-instagram
46	62	Google Scholar	https://scholar.google.com	fa-google
47	65	LinkedIn	https://linkedin.com	fa-linkedin
\.


--
-- TOC entry 3675 (class 0 OID 214146)
-- Dependencies: 266
-- Data for Name: student_member_approval; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.student_member_approval (id, student_id, approved_by, status, note, created_at) FROM stdin;
6	1	7	approved	\N	2025-12-07 18:08:55.926443
7	2	7	rejected	kualifikasi kamu masih belum sesuai	2025-12-07 18:12:54.031655
8	3	7	approved	saya terika kamu	2025-12-07 20:04:22.67576
9	4	7	rejected	Kamu saya Reject	2025-12-07 20:06:05.910202
10	4	7	rejected	kamu saya reject	2025-12-07 20:06:53.359124
11	6	7	rejected	Kamu saya tolak	2025-12-07 20:07:30.752399
12	8	7	approved	Kamu saya terima karena kayaknya kamu ganteng	2025-12-07 20:16:13.727403
13	9	7	rejected	say aendak tau	2025-12-07 20:30:53.459187
14	10	7	rejected	reject	2025-12-07 20:38:34.998351
15	11	7	approved	terima	2025-12-07 20:45:00.072571
16	13	7	approved	saya coba untuk menerima	2025-12-07 21:17:22.678667
17	14	7	rejected	saya mencoba untuk menolak	2025-12-07 21:17:36.991512
18	15	7	approved	saya ingin kamu diterima	2025-12-08 01:45:49.441277
19	16	7	approved	saya approve	2025-12-08 08:39:41.27037
20	17	7	approved	SAYA TERIMA KAMU	2025-12-15 15:42:52.021377
21	18	7	rejected	KAMU SAYA TOLAK	2025-12-15 15:48:03.107182
\.


--
-- TOC entry 3636 (class 0 OID 107667)
-- Dependencies: 218
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, username, password, role_id) FROM stdin;
2	admin	$2a$06$t2JiWnN86rpV6lzrNCMAKuFY83v3h2ZqViDbLItQ2QJ6AO6z2rMuO	2
6	luis	$2a$06$.FAJ0yHPfhS3Dbicp/.CZOi8ozoPKegu2NLFze.u6bH.j5L2Vs7.6	2
5	masih bisa kosong ini	$2a$06$LEmDUhtcw1audAfFS.iVpOWpbe./F8fhdf4CiYWY/dvPdKnK8Stz2	2
7	fajarsieka	$2a$06$g4yvENg65w/2Bc2sCCLqpur62bKofO7uXlK1z5DXCNHA61.etgkF6	2
\.


--
-- TOC entry 3703 (class 0 OID 0)
-- Dependencies: 240
-- Name: activities_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.activities_id_seq', 19, true);


--
-- TOC entry 3704 (class 0 OID 0)
-- Dependencies: 242
-- Name: activity_members_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.activity_members_id_seq', 51, true);


--
-- TOC entry 3705 (class 0 OID 0)
-- Dependencies: 229
-- Name: certifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.certifications_id_seq', 58, true);


--
-- TOC entry 3706 (class 0 OID 0)
-- Dependencies: 231
-- Name: courses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.courses_id_seq', 78, true);


--
-- TOC entry 3707 (class 0 OID 0)
-- Dependencies: 227
-- Name: educations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.educations_id_seq', 57, true);


--
-- TOC entry 3708 (class 0 OID 0)
-- Dependencies: 233
-- Name: expertises_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.expertises_id_seq', 14, true);


--
-- TOC entry 3709 (class 0 OID 0)
-- Dependencies: 221
-- Name: facilities_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.facilities_id_seq', 4, true);


--
-- TOC entry 3710 (class 0 OID 0)
-- Dependencies: 236
-- Name: lab_courses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lab_courses_id_seq', 8, true);


--
-- TOC entry 3711 (class 0 OID 0)
-- Dependencies: 253
-- Name: lab_information_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lab_information_id_seq', 21, true);


--
-- TOC entry 3712 (class 0 OID 0)
-- Dependencies: 257
-- Name: lab_missions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lab_missions_id_seq', 6, true);


--
-- TOC entry 3713 (class 0 OID 0)
-- Dependencies: 255
-- Name: lab_vision_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lab_vision_id_seq', 2, true);


--
-- TOC entry 3714 (class 0 OID 0)
-- Dependencies: 263
-- Name: member_student_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.member_student_id_seq', 18, true);


--
-- TOC entry 3715 (class 0 OID 0)
-- Dependencies: 223
-- Name: members_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.members_id_seq', 68, true);


--
-- TOC entry 3716 (class 0 OID 0)
-- Dependencies: 246
-- Name: project_members_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.project_members_id_seq', 50, true);


--
-- TOC entry 3717 (class 0 OID 0)
-- Dependencies: 244
-- Name: projects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.projects_id_seq', 14, true);


--
-- TOC entry 3718 (class 0 OID 0)
-- Dependencies: 219
-- Name: publications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.publications_id_seq', 26, true);


--
-- TOC entry 3719 (class 0 OID 0)
-- Dependencies: 238
-- Name: research_focuses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.research_focuses_id_seq', 10, true);


--
-- TOC entry 3720 (class 0 OID 0)
-- Dependencies: 215
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roles_id_seq', 11, true);


--
-- TOC entry 3721 (class 0 OID 0)
-- Dependencies: 225
-- Name: social_media_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.social_media_id_seq', 66, true);


--
-- TOC entry 3722 (class 0 OID 0)
-- Dependencies: 265
-- Name: student_member_approval_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.student_member_approval_id_seq', 21, true);


--
-- TOC entry 3723 (class 0 OID 0)
-- Dependencies: 217
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 8, true);


--
-- TOC entry 3438 (class 2606 OID 132244)
-- Name: activities activities_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activities
    ADD CONSTRAINT activities_pkey PRIMARY KEY (id);


--
-- TOC entry 3440 (class 2606 OID 132253)
-- Name: activity_members activity_members_activity_id_member_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_members
    ADD CONSTRAINT activity_members_activity_id_member_id_key UNIQUE (activity_id, member_id);


--
-- TOC entry 3442 (class 2606 OID 132251)
-- Name: activity_members activity_members_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_members
    ADD CONSTRAINT activity_members_pkey PRIMARY KEY (id);


--
-- TOC entry 3424 (class 2606 OID 124096)
-- Name: certifications certifications_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.certifications
    ADD CONSTRAINT certifications_pkey PRIMARY KEY (id);


--
-- TOC entry 3426 (class 2606 OID 124109)
-- Name: courses courses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courses
    ADD CONSTRAINT courses_pkey PRIMARY KEY (id);


--
-- TOC entry 3422 (class 2606 OID 124082)
-- Name: educations educations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.educations
    ADD CONSTRAINT educations_pkey PRIMARY KEY (id);


--
-- TOC entry 3428 (class 2606 OID 124123)
-- Name: expertises expertises_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.expertises
    ADD CONSTRAINT expertises_name_key UNIQUE (name);


--
-- TOC entry 3430 (class 2606 OID 124121)
-- Name: expertises expertises_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.expertises
    ADD CONSTRAINT expertises_pkey PRIMARY KEY (id);


--
-- TOC entry 3412 (class 2606 OID 124036)
-- Name: facilities facilities_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.facilities
    ADD CONSTRAINT facilities_pkey PRIMARY KEY (id);


--
-- TOC entry 3434 (class 2606 OID 132222)
-- Name: lab_courses lab_courses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lab_courses
    ADD CONSTRAINT lab_courses_pkey PRIMARY KEY (id);


--
-- TOC entry 3450 (class 2606 OID 148607)
-- Name: lab_information lab_information_key_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lab_information
    ADD CONSTRAINT lab_information_key_key UNIQUE (key);


--
-- TOC entry 3452 (class 2606 OID 148605)
-- Name: lab_information lab_information_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lab_information
    ADD CONSTRAINT lab_information_pkey PRIMARY KEY (id);


--
-- TOC entry 3456 (class 2606 OID 148631)
-- Name: lab_missions lab_missions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lab_missions
    ADD CONSTRAINT lab_missions_pkey PRIMARY KEY (id);


--
-- TOC entry 3454 (class 2606 OID 148618)
-- Name: lab_vision lab_vision_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lab_vision
    ADD CONSTRAINT lab_vision_pkey PRIMARY KEY (id);


--
-- TOC entry 3432 (class 2606 OID 124128)
-- Name: member_expertises member_expertises_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.member_expertises
    ADD CONSTRAINT member_expertises_pkey PRIMARY KEY (member_id, expertise_id);


--
-- TOC entry 3458 (class 2606 OID 214144)
-- Name: member_student member_student_nim_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.member_student
    ADD CONSTRAINT member_student_nim_key UNIQUE (nim);


--
-- TOC entry 3460 (class 2606 OID 214142)
-- Name: member_student member_student_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.member_student
    ADD CONSTRAINT member_student_pkey PRIMARY KEY (id);


--
-- TOC entry 3414 (class 2606 OID 124051)
-- Name: members members_nidn_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.members
    ADD CONSTRAINT members_nidn_key UNIQUE (nidn);


--
-- TOC entry 3416 (class 2606 OID 124049)
-- Name: members members_nip_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.members
    ADD CONSTRAINT members_nip_key UNIQUE (nip);


--
-- TOC entry 3418 (class 2606 OID 124047)
-- Name: members members_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.members
    ADD CONSTRAINT members_pkey PRIMARY KEY (id);


--
-- TOC entry 3446 (class 2606 OID 132281)
-- Name: project_members project_members_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_members
    ADD CONSTRAINT project_members_pkey PRIMARY KEY (id);


--
-- TOC entry 3448 (class 2606 OID 132283)
-- Name: project_members project_members_project_id_member_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_members
    ADD CONSTRAINT project_members_project_id_member_id_key UNIQUE (project_id, member_id);


--
-- TOC entry 3444 (class 2606 OID 132274)
-- Name: projects projects_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects
    ADD CONSTRAINT projects_pkey PRIMARY KEY (id);


--
-- TOC entry 3410 (class 2606 OID 124027)
-- Name: publications publications_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publications
    ADD CONSTRAINT publications_pkey PRIMARY KEY (id);


--
-- TOC entry 3436 (class 2606 OID 132233)
-- Name: research_focuses research_focuses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.research_focuses
    ADD CONSTRAINT research_focuses_pkey PRIMARY KEY (id);


--
-- TOC entry 3402 (class 2606 OID 107665)
-- Name: roles roles_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_name_key UNIQUE (name);


--
-- TOC entry 3404 (class 2606 OID 107663)
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- TOC entry 3420 (class 2606 OID 124068)
-- Name: social_media social_media_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.social_media
    ADD CONSTRAINT social_media_pkey PRIMARY KEY (id);


--
-- TOC entry 3462 (class 2606 OID 214154)
-- Name: student_member_approval student_member_approval_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.student_member_approval
    ADD CONSTRAINT student_member_approval_pkey PRIMARY KEY (id);


--
-- TOC entry 3406 (class 2606 OID 107672)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 3408 (class 2606 OID 107674)
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- TOC entry 3630 (class 2618 OID 189558)
-- Name: v_member_full _RETURN; Type: RULE; Schema: public; Owner: postgres
--

CREATE OR REPLACE VIEW public.v_member_full AS
 SELECT m.id,
    m.nip,
    m.nidn,
    m.name,
    m.title_prefix,
    m.title_suffix,
    m.program_studi,
    m.jabatan,
    m.email,
    m.phone,
    m.address,
    m.photo,
    m.created_at,
    m.updated_at,
    COALESCE(json_agg(DISTINCT jsonb_build_object('id', sm.id, 'platform', sm.platform, 'icon', sm.icon, 'url', sm.url)) FILTER (WHERE (sm.id IS NOT NULL)), '[]'::json) AS social_media,
    COALESCE(json_agg(DISTINCT jsonb_build_object('id', edu.id, 'degree', edu.degree, 'major', edu.major, 'institution', edu.institution, 'start_year', edu.start_year, 'end_year', edu.end_year)) FILTER (WHERE (edu.id IS NOT NULL)), '[]'::json) AS educations,
    COALESCE(json_agg(DISTINCT jsonb_build_object('id', c.id, 'course_name', c.course_name, 'semester', c.semester)) FILTER (WHERE (c.id IS NOT NULL)), '[]'::json) AS courses,
    COALESCE(json_agg(DISTINCT jsonb_build_object('id', cert.id, 'title', cert.title, 'issuer', cert.issuer, 'issue_date', cert.issue_date, 'expiration_date', cert.expiration_date, 'credential_id', cert.credential_id, 'credential_url', cert.credential_url)) FILTER (WHERE (cert.id IS NOT NULL)), '[]'::json) AS certifications,
    COALESCE(json_agg(DISTINCT jsonb_build_object('id', pub.id, 'title', pub.title, 'date', pub.date, 'link', pub.link)) FILTER (WHERE (pub.id IS NOT NULL)), '[]'::json) AS publications,
    COALESCE(json_agg(DISTINCT jsonb_build_object('id', ex.id, 'name', ex.name)) FILTER (WHERE (ex.id IS NOT NULL)), '[]'::json) AS expertises
   FROM (((((((public.members m
     LEFT JOIN public.social_media sm ON ((sm.member_id = m.id)))
     LEFT JOIN public.educations edu ON ((edu.member_id = m.id)))
     LEFT JOIN public.courses c ON ((c.member_id = m.id)))
     LEFT JOIN public.certifications cert ON ((cert.member_id = m.id)))
     LEFT JOIN public.publications pub ON ((pub.member_id = m.id)))
     LEFT JOIN public.member_expertises me ON ((me.member_id = m.id)))
     LEFT JOIN public.expertises ex ON ((ex.id = me.expertise_id)))
  GROUP BY m.id;


--
-- TOC entry 3631 (class 2618 OID 205942)
-- Name: activity_with_members _RETURN; Type: RULE; Schema: public; Owner: postgres
--

CREATE OR REPLACE VIEW public.activity_with_members AS
 SELECT a.id,
    a.title,
    a.description,
    a.location,
    a.date,
    a.documentation,
    a.created_at,
    a.updated_at,
    COALESCE(json_agg(json_build_object('id', m.id, 'nip', m.nip, 'nidn', m.nidn, 'name', m.name, 'title_prefix', m.title_prefix, 'title_suffix', m.title_suffix, 'program_studi', m.program_studi, 'jabatan', m.jabatan, 'email', m.email, 'phone', m.phone, 'address', m.address, 'photo', m.photo, 'role', am.role)) FILTER (WHERE (m.id IS NOT NULL)), '[]'::json) AS members
   FROM ((public.activities a
     LEFT JOIN public.activity_members am ON ((am.activity_id = a.id)))
     LEFT JOIN public.members m ON ((m.id = am.member_id)))
  GROUP BY a.id;


--
-- TOC entry 3632 (class 2618 OID 205947)
-- Name: project_with_members _RETURN; Type: RULE; Schema: public; Owner: postgres
--

CREATE OR REPLACE VIEW public.project_with_members AS
 SELECT p.id,
    p.name,
    p.description,
    p.start_date,
    p.end_date,
    p.sponsor,
    p.documentation,
    p.created_at,
    p.updated_at,
    COALESCE(json_agg(json_build_object('id', m.id, 'nip', m.nip, 'nidn', m.nidn, 'name', m.name, 'title_prefix', m.title_prefix, 'title_suffix', m.title_suffix, 'program_studi', m.program_studi, 'jabatan', m.jabatan, 'email', m.email, 'phone', m.phone, 'address', m.address, 'photo', m.photo, 'role', pm.role)) FILTER (WHERE (m.id IS NOT NULL)), '[]'::json) AS members
   FROM ((public.projects p
     LEFT JOIN public.project_members pm ON ((pm.project_id = p.id)))
     LEFT JOIN public.members m ON ((m.id = pm.member_id)))
  GROUP BY p.id;


--
-- TOC entry 3476 (class 2606 OID 132254)
-- Name: activity_members activity_members_activity_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_members
    ADD CONSTRAINT activity_members_activity_id_fkey FOREIGN KEY (activity_id) REFERENCES public.activities(id) ON DELETE CASCADE;


--
-- TOC entry 3477 (class 2606 OID 132259)
-- Name: activity_members activity_members_member_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_members
    ADD CONSTRAINT activity_members_member_id_fkey FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3469 (class 2606 OID 124097)
-- Name: certifications certifications_member_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.certifications
    ADD CONSTRAINT certifications_member_id_fkey FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3471 (class 2606 OID 124110)
-- Name: courses courses_member_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courses
    ADD CONSTRAINT courses_member_id_fkey FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3467 (class 2606 OID 124083)
-- Name: educations educations_member_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.educations
    ADD CONSTRAINT educations_member_id_fkey FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3470 (class 2606 OID 173177)
-- Name: certifications fk_cert_member; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.certifications
    ADD CONSTRAINT fk_cert_member FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3472 (class 2606 OID 173182)
-- Name: courses fk_course_member; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.courses
    ADD CONSTRAINT fk_course_member FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3468 (class 2606 OID 173187)
-- Name: educations fk_edu_member; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.educations
    ADD CONSTRAINT fk_edu_member FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3473 (class 2606 OID 173172)
-- Name: member_expertises fk_expert_member; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.member_expertises
    ADD CONSTRAINT fk_expert_member FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3464 (class 2606 OID 124057)
-- Name: publications fk_member; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publications
    ADD CONSTRAINT fk_member FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3465 (class 2606 OID 173192)
-- Name: social_media fk_social_member; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.social_media
    ADD CONSTRAINT fk_social_member FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3474 (class 2606 OID 124134)
-- Name: member_expertises member_expertises_expertise_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.member_expertises
    ADD CONSTRAINT member_expertises_expertise_id_fkey FOREIGN KEY (expertise_id) REFERENCES public.expertises(id) ON DELETE CASCADE;


--
-- TOC entry 3475 (class 2606 OID 124129)
-- Name: member_expertises member_expertises_member_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.member_expertises
    ADD CONSTRAINT member_expertises_member_id_fkey FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3478 (class 2606 OID 132289)
-- Name: project_members project_members_member_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_members
    ADD CONSTRAINT project_members_member_id_fkey FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3479 (class 2606 OID 132284)
-- Name: project_members project_members_project_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_members
    ADD CONSTRAINT project_members_project_id_fkey FOREIGN KEY (project_id) REFERENCES public.projects(id) ON DELETE CASCADE;


--
-- TOC entry 3466 (class 2606 OID 124069)
-- Name: social_media social_media_member_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.social_media
    ADD CONSTRAINT social_media_member_id_fkey FOREIGN KEY (member_id) REFERENCES public.members(id) ON DELETE CASCADE;


--
-- TOC entry 3480 (class 2606 OID 222323)
-- Name: student_member_approval student_member_approval_approved_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.student_member_approval
    ADD CONSTRAINT student_member_approval_approved_by_fkey FOREIGN KEY (approved_by) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- TOC entry 3481 (class 2606 OID 214155)
-- Name: student_member_approval student_member_approval_student_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.student_member_approval
    ADD CONSTRAINT student_member_approval_student_id_fkey FOREIGN KEY (student_id) REFERENCES public.member_student(id) ON DELETE CASCADE;


--
-- TOC entry 3463 (class 2606 OID 107675)
-- Name: users users_role_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_role_id_fkey FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


-- Completed on 2025-12-19 13:08:24

--
-- PostgreSQL database dump complete
--

