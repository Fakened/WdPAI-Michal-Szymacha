PGDMP                       |            ogzlkhoz     13.9 (Ubuntu 13.9-1.pgdg20.04+1)    16.0 6    <           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            =           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            >           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            ?           1262    52822520    ogzlkhoz    DATABASE     t   CREATE DATABASE ogzlkhoz WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.UTF-8';
    DROP DATABASE ogzlkhoz;
                ogzlkhoz    false            @           0    0    DATABASE ogzlkhoz    ACL     ;   REVOKE CONNECT,TEMPORARY ON DATABASE ogzlkhoz FROM PUBLIC;
                   ogzlkhoz    false    4159                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                postgres    false            A           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                   postgres    false    25            B           0    0    SCHEMA public    ACL     Q   REVOKE USAGE ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO PUBLIC;
                   postgres    false    25            �           1255    55838755    count_open_tasks(integer)    FUNCTION     %  CREATE FUNCTION public.count_open_tasks(user_id_param integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    task_count INTEGER;
BEGIN
    SELECT COUNT(*)
    INTO task_count
    FROM task
    WHERE user_id = user_id_param AND status = FALSE;
    
    RETURN task_count;
END;
$$;
 >   DROP FUNCTION public.count_open_tasks(user_id_param integer);
       public          ogzlkhoz    false    25            �           1255    55838753    set_creation_date()    FUNCTION     �   CREATE FUNCTION public.set_creation_date() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
   NEW.date_of_create := CURRENT_DATE;
   RETURN NEW;
END;
$$;
 *   DROP FUNCTION public.set_creation_date();
       public          ogzlkhoz    false    25            �            1259    54564974    task    TABLE       CREATE TABLE public.task (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    date date NOT NULL,
    "time" time without time zone NOT NULL,
    prio integer NOT NULL,
    description text,
    status boolean NOT NULL,
    date_of_create date
);
    DROP TABLE public.task;
       public         heap    ogzlkhoz    false    25            �            1259    54564972    task_id_seq    SEQUENCE     �   CREATE SEQUENCE public.task_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.task_id_seq;
       public          ogzlkhoz    false    25    229            C           0    0    task_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.task_id_seq OWNED BY public.task.id;
          public          ogzlkhoz    false    228            �            1259    54564991 
   tasks_team    TABLE     _   CREATE TABLE public.tasks_team (
    team_id integer NOT NULL,
    task_id integer NOT NULL
);
    DROP TABLE public.tasks_team;
       public         heap    ogzlkhoz    false    25            �            1259    54564980 
   tasks_user    TABLE     _   CREATE TABLE public.tasks_user (
    user_id integer NOT NULL,
    task_id integer NOT NULL
);
    DROP TABLE public.tasks_user;
       public         heap    ogzlkhoz    false    25            �            1259    54564985    team    TABLE     m   CREATE TABLE public.team (
    id integer NOT NULL,
    users_id integer NOT NULL,
    name text NOT NULL
);
    DROP TABLE public.team;
       public         heap    ogzlkhoz    false    25            �            1259    54564983    team_id_seq    SEQUENCE     �   CREATE SEQUENCE public.team_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.team_id_seq;
       public          ogzlkhoz    false    25    232            D           0    0    team_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.team_id_seq OWNED BY public.team.id;
          public          ogzlkhoz    false    231            �            1259    54564963    user    TABLE     �   CREATE TABLE public."user" (
    id integer NOT NULL,
    is_admin boolean NOT NULL,
    pass character varying(255) NOT NULL,
    login character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    team_id bigint
);
    DROP TABLE public."user";
       public         heap    ogzlkhoz    false    25            �            1259    55838638 	   team_info    VIEW     �   CREATE VIEW public.team_info AS
 SELECT "user".id,
    "user".email,
    "user".team_id,
    team.name
   FROM (public."user"
     LEFT JOIN public.team ON (("user".team_id = team.id)));
    DROP VIEW public.team_info;
       public          ogzlkhoz    false    227    232    232    227    227    25            �            1259    54564961    user_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.user_id_seq;
       public          ogzlkhoz    false    227    25            E           0    0    user_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;
          public          ogzlkhoz    false    226            �            1259    54564996 	   user_info    TABLE     �   CREATE TABLE public.user_info (
    user_id integer NOT NULL,
    name text NOT NULL,
    surname text NOT NULL,
    phone text
);
    DROP TABLE public.user_info;
       public         heap    ogzlkhoz    false    25            �            1259    54564994    user_info_user_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_info_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.user_info_user_id_seq;
       public          ogzlkhoz    false    235    25            F           0    0    user_info_user_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.user_info_user_id_seq OWNED BY public.user_info.user_id;
          public          ogzlkhoz    false    234            �            1259    55750945    user_information    VIEW     �   CREATE VIEW public.user_information AS
 SELECT "user".id,
    "user".email,
    user_info.name,
    user_info.surname,
    user_info.phone
   FROM (public."user"
     LEFT JOIN public.user_info ON (("user".id = user_info.user_id)));
 #   DROP VIEW public.user_information;
       public          ogzlkhoz    false    227    227    235    235    235    235    25            �           2604    54564977    task id    DEFAULT     b   ALTER TABLE ONLY public.task ALTER COLUMN id SET DEFAULT nextval('public.task_id_seq'::regclass);
 6   ALTER TABLE public.task ALTER COLUMN id DROP DEFAULT;
       public          ogzlkhoz    false    228    229    229            �           2604    54564988    team id    DEFAULT     b   ALTER TABLE ONLY public.team ALTER COLUMN id SET DEFAULT nextval('public.team_id_seq'::regclass);
 6   ALTER TABLE public.team ALTER COLUMN id DROP DEFAULT;
       public          ogzlkhoz    false    231    232    232            �           2604    54564966    user id    DEFAULT     d   ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);
 8   ALTER TABLE public."user" ALTER COLUMN id DROP DEFAULT;
       public          ogzlkhoz    false    227    226    227            �           2604    54564999    user_info user_id    DEFAULT     v   ALTER TABLE ONLY public.user_info ALTER COLUMN user_id SET DEFAULT nextval('public.user_info_user_id_seq'::regclass);
 @   ALTER TABLE public.user_info ALTER COLUMN user_id DROP DEFAULT;
       public          ogzlkhoz    false    235    234    235            3          0    54564974    task 
   TABLE DATA           a   COPY public.task (id, name, date, "time", prio, description, status, date_of_create) FROM stdin;
    public          ogzlkhoz    false    229   7<       7          0    54564991 
   tasks_team 
   TABLE DATA           6   COPY public.tasks_team (team_id, task_id) FROM stdin;
    public          ogzlkhoz    false    233   �?       4          0    54564980 
   tasks_user 
   TABLE DATA           6   COPY public.tasks_user (user_id, task_id) FROM stdin;
    public          ogzlkhoz    false    230   @       6          0    54564985    team 
   TABLE DATA           2   COPY public.team (id, users_id, name) FROM stdin;
    public          ogzlkhoz    false    232   \@       1          0    54564963    user 
   TABLE DATA           K   COPY public."user" (id, is_admin, pass, login, email, team_id) FROM stdin;
    public          ogzlkhoz    false    227   �@       9          0    54564996 	   user_info 
   TABLE DATA           B   COPY public.user_info (user_id, name, surname, phone) FROM stdin;
    public          ogzlkhoz    false    235   ,B       G           0    0    task_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.task_id_seq', 43, true);
          public          ogzlkhoz    false    228            H           0    0    team_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.team_id_seq', 1, true);
          public          ogzlkhoz    false    231            I           0    0    user_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.user_id_seq', 10, true);
          public          ogzlkhoz    false    226            J           0    0    user_info_user_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.user_info_user_id_seq', 1, false);
          public          ogzlkhoz    false    234            �           2606    54564979    task task_pk 
   CONSTRAINT     J   ALTER TABLE ONLY public.task
    ADD CONSTRAINT task_pk PRIMARY KEY (id);
 6   ALTER TABLE ONLY public.task DROP CONSTRAINT task_pk;
       public            ogzlkhoz    false    229            �           2606    54564990    team team_pk 
   CONSTRAINT     J   ALTER TABLE ONLY public.team
    ADD CONSTRAINT team_pk PRIMARY KEY (id);
 6   ALTER TABLE ONLY public.team DROP CONSTRAINT team_pk;
       public            ogzlkhoz    false    232            �           2606    54565004    user_info user_info_pk 
   CONSTRAINT     Y   ALTER TABLE ONLY public.user_info
    ADD CONSTRAINT user_info_pk PRIMARY KEY (user_id);
 @   ALTER TABLE ONLY public.user_info DROP CONSTRAINT user_info_pk;
       public            ogzlkhoz    false    235            �           2606    54564971    user user_pk 
   CONSTRAINT     L   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pk PRIMARY KEY (id);
 8   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pk;
       public            ogzlkhoz    false    227            �           1259    55750009    fki_user_fk0    INDEX     B   CREATE INDEX fki_user_fk0 ON public."user" USING btree (team_id);
     DROP INDEX public.fki_user_fk0;
       public            ogzlkhoz    false    227            �           1259    54565038    login    INDEX     �   CREATE INDEX login ON public."user" USING btree (login, pass, email) INCLUDE (login, pass, email) WITH (deduplicate_items='true');
    DROP INDEX public.login;
       public            ogzlkhoz    false    227    227    227    227    227    227            �           2620    55838754 %   task set_date_of_create_before_insert    TRIGGER     �   CREATE TRIGGER set_date_of_create_before_insert BEFORE INSERT ON public.task FOR EACH ROW EXECUTE FUNCTION public.set_creation_date();
 >   DROP TRIGGER set_date_of_create_before_insert ON public.task;
       public          ogzlkhoz    false    229    970            �           2606    54565020    tasks_team tasks_team_fk0    FK CONSTRAINT     w   ALTER TABLE ONLY public.tasks_team
    ADD CONSTRAINT tasks_team_fk0 FOREIGN KEY (team_id) REFERENCES public.team(id);
 C   ALTER TABLE ONLY public.tasks_team DROP CONSTRAINT tasks_team_fk0;
       public          ogzlkhoz    false    4000    233    232            �           2606    54565025    tasks_team tasks_team_fk1    FK CONSTRAINT     w   ALTER TABLE ONLY public.tasks_team
    ADD CONSTRAINT tasks_team_fk1 FOREIGN KEY (task_id) REFERENCES public.task(id);
 C   ALTER TABLE ONLY public.tasks_team DROP CONSTRAINT tasks_team_fk1;
       public          ogzlkhoz    false    3998    233    229            �           2606    54565005    tasks_user tasks_user_fk0    FK CONSTRAINT     y   ALTER TABLE ONLY public.tasks_user
    ADD CONSTRAINT tasks_user_fk0 FOREIGN KEY (user_id) REFERENCES public."user"(id);
 C   ALTER TABLE ONLY public.tasks_user DROP CONSTRAINT tasks_user_fk0;
       public          ogzlkhoz    false    3996    227    230            �           2606    54565010    tasks_user tasks_user_fk1    FK CONSTRAINT     w   ALTER TABLE ONLY public.tasks_user
    ADD CONSTRAINT tasks_user_fk1 FOREIGN KEY (task_id) REFERENCES public.task(id);
 C   ALTER TABLE ONLY public.tasks_user DROP CONSTRAINT tasks_user_fk1;
       public          ogzlkhoz    false    230    3998    229            �           2606    54565015    team team_fk0    FK CONSTRAINT     n   ALTER TABLE ONLY public.team
    ADD CONSTRAINT team_fk0 FOREIGN KEY (users_id) REFERENCES public."user"(id);
 7   ALTER TABLE ONLY public.team DROP CONSTRAINT team_fk0;
       public          ogzlkhoz    false    3996    232    227            �           2606    55750004    user user_fk0    FK CONSTRAINT     w   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_fk0 FOREIGN KEY (team_id) REFERENCES public.team(id) NOT VALID;
 9   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_fk0;
       public          ogzlkhoz    false    232    227    4000            �           2606    54565030    user_info user_info_fk0    FK CONSTRAINT     w   ALTER TABLE ONLY public.user_info
    ADD CONSTRAINT user_info_fk0 FOREIGN KEY (user_id) REFERENCES public."user"(id);
 A   ALTER TABLE ONLY public.user_info DROP CONSTRAINT user_info_fk0;
       public          ogzlkhoz    false    227    235    3996            3   �  x��Vɒ�6=S_�ȨHP�͇�&KU��/�%#A
�T��<�"Y���0#	x��u7��]������~��[���SWQ�/������P\�n�w���E�?���Ѵ���7ю���.�*��"m�VVo�n�m���Vat����AO�j������z�t�r���|fV3�?0y��Q�}�n_��T���5g�X���qmw)�x,�5�-��d\Ϣ��<d�.�\��é�)�g���ЇB�('8��z��qb���-�evǋ��R�T�B�d�;˜�L��aMg5�|�LH�
4�\i�CGF*����Sۃ�L����x<����d�X+.F0��5�5�C��	2$�`n�C*�j�k���H���Y�F}��kH�U��H�:����[�*�k����&X<] ��<0o�F�B�_��`�l�An�nA��OPw1�9M��u@���`ȃ��#�pN0%��W��P�aF}|�Q��QT+��G�q�1�{HeL�MyA��d�8�����	 :|/�����=!zۍ!XǊJՒ�)��-�%�"Er��d�5 ��C�s��P���uZ�F� �P��-�q��Ԑn�>Ꮁ>X8�XqSR��F
n]?gh4b"�ˣ�6��7�G�¦v&�@�qY��褉qu��m#|��C�nS6���]���7��\��4�����Vd;�s��C��T���L�Z���e���6���s�W?
��,�A�S]�m����%lj��t��SUO�����l+�aN��P������v��	T��>�Et|�r�΍z���V�+E}(r���z꽘����E�6L����B�|��9<��f=�0�'Ρ@f�5����a�� ���|yx�b���O.*����7�_&F1ɻ�/��z���pJT������˥����	TE�V0ӟ�/�׫�����$      7      x�3�42����� RV      4   <   x�=ʱ�0�X_c�@�^�|N6���`(��77<�٭a�9�9J�!����      6      x�3�4�,I-.�/IM������ 5Q�      1   �  x�u�I��PF��;\#�ɸeRh�"�Be� `e�ׇt��+Uٜ��-N�����
�+D�v6�s�z�μ>�%���*f`�ˁ�+��Mz.k���I�J���I@�D�W�Ƭܔ�6o��'�ء��-��8�0���S����^�
��-�/Rx��퐤�#ؾ�Y��s���G6p,γr�l�F{5t��l���=FD-�T�$ ���6�/;%c�K=0�0,�6����;�*��I��ovX�N���O,�.j�o $��>���s���
�? �W��J�Z�Er!�r�F�*O|[��9_t[]#�����df�$&iZB������S�	d�2�:�P����!��p����PJ*l�>�����Z&�8�y�R4��#���7�E��oSƯc      9   P   x���,O-L�,�`�`q�s����K�����������������8����+9����8����+F��� �&�     