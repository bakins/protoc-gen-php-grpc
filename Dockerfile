FROM golang:1.9.1

RUN apt-get update && \
    apt-get install -y git curl make unzip zlib1g-dev libc-ares-dev && \
    apt-get clean -y && \
    cd /tmp && \
    curl --fail -L -O https://github.com/google/protobuf/releases/download/v3.5.1/protoc-3.5.1-linux-x86_64.zip && \
    unzip protoc-3.5.1-linux-x86_64.zip && \
    cp bin/protoc /usr/bin && \
    cp -R -v include/google /usr/include/

RUN  apt-get update && \
    apt-get install -y build-essential autoconf libtool && \
    apt-get clean -y && \
    git clone -b v1.8.x --depth 1 https://github.com/grpc/grpc && \
    cd grpc && \
    git submodule update --init && \
    make && \ 
    make grpc_php_plugin && \
    make install

RUN cp bins/opt/grpc_php_plugin /usr/local/bin/grpc_php_plugin

#RUN apt-get update && \
#    apt-get install -y git autoconf automake libtool curl make g++ unzip php-pear php5-dev autoconf automake libtool make gcc && \
#    apt-get clean -y && \
#    cd /tmp && \
#    curl -L --fail -O https://github.com/google/protobuf/archive/v3.4.1.tar.gz && \
#    tar -zxvf v3.4.1.tar.gz

#RUN cd /tmp && \
#    cd protobuf-3.4.1 && \
#    ./autogen.sh && \
#    ./configure --prefix=/usr && \
#    make && \
#    make check && \
#    make install && \
#    ldconfig

#RUN cd /tmp && \
#    git clone -b v1.6.x https://github.com/grpc/grpc && \
#    cd grpc && \
#    make grpc_php_plugin

