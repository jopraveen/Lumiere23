FROM ubuntu@sha256:2adf22367284330af9f832ffefb717c78239f6251d9d0f58de50b86229ed1427
ENV LC_CTYPE C.UTF-8
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get install -y socat gdb strace

RUN adduser --system --shell /bin/sh lumierectf
RUN groupadd -f lumierectf
USER lumierectf
RUN mkdir /home/lumierectf/challenge

# set permissions
USER root
RUN chown -R lumierectf:lumierectf /home/lumierectf/challenge/
RUN chmod -R 555 /home/lumierectf/challenge/
RUN ls -l /home/lumierectf/challenge/

USER lumierectf
COPY ./flag.txt /home/lumierectf/challenge/flag.txt
COPY ./ld-2.35.so /home/lumierectf/challenge/ld-2.35.so
COPY ./libc.so.6 /home/lumierectf/challenge/libc.so.6
COPY ./printf_as_a_service /home/lumierectf/challenge/printf_as_a_service
WORKDIR /home/lumierectf/challenge
EXPOSE 9001
CMD ["socat", "tcp-l:9001,reuseaddr,fork", "exec:stdbuf -i 0 -o 0 -e 0 /home/lumierectf/challenge/printf_as_a_service"]